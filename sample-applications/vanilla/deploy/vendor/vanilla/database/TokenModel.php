<?php

namespace vanilla\database;

require_once CITYPHP . 'bcryptHash.php';
require_once CITYPHP . 'time/datetimeNow.php';

use cityphp\database\DatabaseAdapter;
use cityphp\database\DatabaseHandle;

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
            PRIMARY KEY (token_id))
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
            VALUES (%d, "%s", "%s", "%s")',
            $this->tableName,
            $userID,
            $this->esc(bcryptHash($token, BCRYPT_COST)),
            $this->esc($data),
            datetimeNow()));
    }

    protected function getToken($userID, $token) {
        $query = sprintf('SELECT token_id, token, data, users.user_id, username
            FROM %s AS users, %s AS tokens
            WHERE tokens.creation_date > "%s" - INTERVAL %d DAY
            AND tokens.user_id = %d AND tokens.user_id = users.user_id
            ORDER BY tokens.creation_date DESC',
            TABLE_USERS,
            $this->tableName,
            datetimeNow(),
            $this->ttl,
            $userID);

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
