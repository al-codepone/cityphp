<?php

require_once(CITYPHP . 'database/DatabaseAdapter.php');
require_once(CITYPHP . 'getHash.php');

class UserModel extends DatabaseAdapter {
    public function install() {
        $queries = array();

        $queries[] = 'CREATE TABLE ' . TABLE_USERS . ' (
            user_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
			username VARCHAR(32),
            password VARCHAR(128),
            PRIMARY KEY (user_id))
            ENGINE = MYISAM';

        $queries[] = 'CREATE TABLE ' . TABLE_PERSISTENT_LOGIN_TOKENS . ' (
            token_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id MEDIUMINT UNSIGNED,
            creation_date DATETIME,
            token VARCHAR(128),
            PRIMARY KEY (token_id))
            ENGINE = MYISAM';

        foreach($queries as $query) {
            $this->query($query);
        }
    }

    public function createUser($data) {
        $query = sprintf('INSERT INTO %s (user_id, username, password) VALUES(NULL, "%s", "%s")',
            TABLE_USERS,
            $this->esc($data['username']),
            $this->esc(getHash($data['password'])));

        $this->query($query);
    }

    public function getUserWithUsername($username) {
        $query = sprintf('SELECT user_id, username, password FROM %s WHERE username = "%s"',
            TABLE_USERS,
            $this->esc($username));

        $queryData = $this->fetchQuery($query);
        return $queryData[0];
    }

    public function updateUser($userID, $data) {
        $passwordPart = $data['new_password']
            ? sprintf(', password = "%s"', $this->esc(getHash($data['new_password'])))
            : '';

        $query = sprintf('UPDATE %s SET username = "%s"%s WHERE user_id = %d',
            TABLE_USERS,
            $this->esc($data['username']),
            $passwordPart,
            $userID);

        $this->query($query);
    }

    public function deleteUser($userID) {
        $query = sprintf('DELETE FROM %s WHERE user_id = %d',
            TABLE_USERS,
            $userID);

        $this->query($query);
    }

    public function getLoggedInUser() {
        if(isset($_SESSION[SESSION_USER_ID])) {
            return $this->getSessionUser();
        }
        else if($data = $this->getPersistentLogin()) {
            $this->deletePersistentLoginToken($data['token_id']);
            $this->setPersistentLogin($data['user_id']);

            $_SESSION[SESSION_USER_ID] = $data['user_id'];
            $_SESSION[SESSION_USERNAME] = $data['username'];
            return $this->getSessionUser();
        }
    }

    public function setPersistentLogin($userID) {
        $token = sha1(uniqid(mt_rand(), true));
        setcookie(COOKIE_PERSISTENT_LOGIN, "$userID.$token",
            time() + 60*60*24*PERSISTENT_LOGIN_DAYS);

        $query = sprintf('INSERT INTO %s (token_id, user_id, creation_date, token)
            VALUES(NULL, %d, "%s", "%s")',
            TABLE_PERSISTENT_LOGIN_TOKENS,
            $userID,
            date('Y-m-d H:i:s'),
            getHash($token));

        $this->query($query);
    }

    public function deletePersistentLogin() {
        if($data = $this->getPersistentLogin()) {
            $this->deletePersistentLoginToken($data['token_id']);
        }

        setcookie(COOKIE_PERSISTENT_LOGIN, '', time() - 3600);
    }

    private function getPersistentLogin() {
        if($_COOKIE[COOKIE_PERSISTENT_LOGIN]) {
            list($userID, $token) = explode('.', $_COOKIE[COOKIE_PERSISTENT_LOGIN]);

            $query = sprintf('SELECT token_id, token, users.user_id, username
                FROM %s AS users, %s AS tokens
                WHERE tokens.creation_date > "%s" - INTERVAL %d DAY
                AND tokens.user_id = %d AND tokens.user_id = users.user_id
                ORDER BY tokens.creation_date DESC',
                TABLE_USERS,
                TABLE_PERSISTENT_LOGIN_TOKENS,
                date('Y-m-d H:i:s'),
                PERSISTENT_LOGIN_DAYS,
                $userID);

            foreach($this->fetchQuery($query) as $row) {
                if($row['token'] == getHash($token, $row['token'])) {
                    return $row;
                }
            }
        }
    }

    private function deletePersistentLoginToken($tokenID) {
        $query = sprintf('DELETE FROM %s WHERE token_id = %d',
            TABLE_PERSISTENT_LOGIN_TOKENS,
            $tokenID);

        $this->query($query);
    }

    private function getSessionUser() {
        return array('user_id' => $_SESSION[SESSION_USER_ID],
            'username' => $_SESSION[SESSION_USERNAME]);
    }
}

?>
