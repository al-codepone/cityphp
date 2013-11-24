<?php

namespace vanilla\database;

require_once CITYPHP . 'bcryptHash.php';
require_once CITYPHP . 'time/datetimeNow.php';

use cityphp\db\DatabaseAdapter;
use cityphp\db\DatabaseHandle;

abstract class TokenModel extends DatabaseAdapter {
    private $tableName;
    private $ttl;

    public function __construct(DatabaseHandle $databaseHandle, $tableName, $ttl) {
        parent::__construct($databaseHandle);
        $this->tableName = $tableName;
        $this->ttl = $ttl;
    }

    public function install() {
        $this->query('CREATE TABLE ' . $this->tableName . ' (
            token_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id MEDIUMINT UNSIGNED,
            token VARCHAR(128),
            data VARCHAR(255),
            creation_date DATETIME,
            PRIMARY KEY(token_id))
            ENGINE = MYISAM');
    }

    public function prune() {
        $this->query(sprintf('DELETE FROM %s
            WHERE creation_date < "%s" - INTERVAL %d DAY',
            $this->tableName,
            datetimeNow(),
            $this->ttl));
    }

    protected function createToken($userID, $token, $data = '') {
        $this->query(sprintf('INSERT INTO %s (user_id, token, data, creation_date)
            VALUES(%d, "%s", "%s", "%s")',
            $this->tableName,
            $userID,
            $this->esc(bcryptHash($token, BCRYPT_COST)),
            $this->esc($data),
            datetimeNow()));
    }

    protected function getToken($userID, $token) {
        $query = sprintf('SELECT t.token_id, t.token, t.data, u.user_id, u.username
            FROM %s t JOIN %s u ON t.user_id = u.user_id
            WHERE t.user_id = %d AND t.creation_date > "%s" - INTERVAL %d DAY
            ORDER BY t.creation_date DESC',
            $this->tableName,
            TABLE_USERS,
            $userID,
            datetimeNow(),
            $this->ttl);

        foreach($this->fetchQuery($query) as $row) {
            if($row['token'] == bcryptHash($token, $row['token'])) {
                return $row;
            }
        }
    }

    protected function deleteToken($tokenID) {
        $this->query(sprintf('DELETE FROM %s WHERE token_id = %d',
            $this->tableName,
            $tokenID));
    }    
}

?>
