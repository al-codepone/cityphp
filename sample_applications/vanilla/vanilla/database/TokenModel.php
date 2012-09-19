<?php

require_once(CITYPHP . 'database/DatabaseAdapter.php');
require_once(CITYPHP . 'getHash.php');

abstract class TokenModel extends DatabaseAdapter {
    private $tableName;

    public function __construct(DatabaseHandle $databaseHandle, $tableName) {
        parent::__construct($databaseHandle);
        $this->tableName = $tableName;
    }

    public function install() {
        $this->query('CREATE TABLE ' . $this->tableName . ' (
            token_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id MEDIUMINT UNSIGNED,
            creation_date DATETIME,
            token VARCHAR(128),
            PRIMARY KEY (token_id))
            ENGINE = MYISAM');
    }

    protected function createToken($userID, $token) {
        $this->query(sprintf('INSERT INTO %s
            (token_id, user_id, creation_date, token)
            VALUES(NULL, %d, "%s", "%s")',
            $this->tableName,
            $userID,
            date('Y-m-d H:i:s'),
            getHash($token)));
    }

    protected function getToken($userID, $token) {
        $query = sprintf('SELECT token_id, token, users.user_id, username
            FROM %s AS users, %s AS tokens
            WHERE tokens.creation_date > "%s" - INTERVAL %d DAY
            AND tokens.user_id = %d AND tokens.user_id = users.user_id
            ORDER BY tokens.creation_date DESC',
            TABLE_USERS,
            $this->tableName,
            date('Y-m-d H:i:s'),
            7,
            $userID);

        foreach($this->fetchQuery($query) as $row) {
            if($row['token'] == getHash($token, $row['token'])) {
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
