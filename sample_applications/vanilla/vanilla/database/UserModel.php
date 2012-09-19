<?php

require_once(CITYPHP . 'database/DatabaseAdapter.php');
require_once(CITYPHP . 'getHash.php');

class UserModel extends DatabaseAdapter {
    public function install() {
        $this->query('CREATE TABLE ' . TABLE_USERS . ' (
            user_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
			username VARCHAR(32),
            password VARCHAR(128),
            PRIMARY KEY (user_id))
            ENGINE = MYISAM');
    }

    public function createUser($data) {
        $this->query(sprintf('INSERT INTO %s
            (user_id, username, password) VALUES(NULL, "%s", "%s")',
            TABLE_USERS,
            $this->esc($data['username']),
            $this->esc(getHash($data['password']))));
    }

    public function getUserWithUsername($username) {
        $queryData = $this->fetchQuery(sprintf('SELECT user_id, username, password
            FROM %s WHERE username = "%s"',
            TABLE_USERS,
            $this->esc($username)));

        return $queryData[0];
    }

    public function updateUser($userID, $data) {
        $this->query(sprintf('UPDATE %1$s SET username = "%2$s"%4$s WHERE user_id = %3$d',
            TABLE_USERS,
            $this->esc($data['username']),
            $userID,
            $data['new_password']
                ? sprintf(', password = "%s"', $this->esc(getHash($data['new_password'])))
                : ''));
    }

    public function deleteUser($userID) {
        $this->query(sprintf('DELETE FROM %s WHERE user_id = %d',
            TABLE_USERS,
            $userID));
    }
}

?>
