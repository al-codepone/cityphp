<?php

require_once(CITY_PHP . 'database/MySqlDatabaseHandle.php');
require_once(CITY_PHP . 'functions.php');

class DatabaseApi extends MySqlDatabaseHandle {
    public function __construct() {
        parent::__construct(DATABASE_HOST,
            DATABASE_USERNAME,
            DATABASE_PASSWORD,
            DATABASE_NAME);
    }

    public function install() {
        $queries = array();

        $queries[] = 'CREATE TABLE ' . TABLE_MESSAGES . ' (
            message_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id MEDIUMINT UNSIGNED NOT NULL,
            creation_date DATETIME,
            message TEXT NOT NULL DEFAULT "",
            PRIMARY KEY (message_id))
            ENGINE = MYISAM';

        $queries[] = 'CREATE TABLE ' . TABLE_USERS . ' (
            user_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
			username VARCHAR(32) NOT NULL DEFAULT "",
            password VARCHAR(128) NOT NULL DEFAULT "",
            PRIMARY KEY (user_id))
            ENGINE = MYISAM';

        $queries[] = 'CREATE TABLE ' . TABLE_PERSISTENT_LOGIN_TOKENS . ' (
            token_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id MEDIUMINT UNSIGNED NOT NULL,
            creation_date DATETIME,
            token VARCHAR(128) NOT NULL DEFAULT "",
            PRIMARY KEY (token_id))
            ENGINE = MYISAM';

        foreach($queries as $query) {
            $this->query($query);
        }
    }

    public function getNumMessages() {
        $query = 'SELECT COUNT(*) AS count FROM ' . TABLE_MESSAGES;
        $queryData = $this->fetchQuery($query);
        return $queryData[0]['count'];
    }

    public function getNumUserMessages($userID) {
        $query = sprintf('SELECT COUNT(*) AS count FROM %s WHERE user_id = %d',
            TABLE_MESSAGES, $userID);

        $queryData = $this->fetchQuery($query);
        return $queryData[0]['count'];
    }

    public function getMessage($messageID) {
        $query = sprintf('SELECT message_id, creation_date, message, username
            FROM %s, %s WHERE messages.user_id = users.user_id AND message_id = %d',
            TABLE_MESSAGES, TABLE_USERS, $messageID);

        $queryData = $this->fetchQuery($query);
        return $queryData[0];
    }

    public function getMessages($pageNum) {
        $query = sprintf('SELECT message_id, creation_date, message, username
            FROM %s, %s
            WHERE messages.user_id = users.user_id
            ORDER BY creation_date DESC LIMIT %d, %d',
            TABLE_MESSAGES, TABLE_USERS, ($pageNum - 1)*MESSAGES_PER_PAGE, MESSAGES_PER_PAGE);

        return $this->fetchQuery($query);
    }

    public function getUserMessages($pageNum, $userID) {
        $query = sprintf('SELECT message_id, creation_date, message, username
            FROM %s, %s
            WHERE messages.user_id = %d AND messages.user_id = users.user_id
            ORDER BY creation_date DESC LIMIT %d, %d',
            TABLE_MESSAGES, TABLE_USERS, $userID, ($pageNum - 1)*MESSAGES_PER_PAGE, MESSAGES_PER_PAGE);

        return $this->fetchQuery($query);
    }

    public function addMessage($message, $userID) {
        $query = sprintf('INSERT INTO %s (message_id, user_id, creation_date, message) VALUES(NULL, %d, "%s", "%s")',
            TABLE_MESSAGES, $userID, date('Y-m-d H:i:s'), $this->escapeString($message));

        $this->query($query);
    }

    public function getUserWithUsername($username) {
        $query = sprintf('SELECT user_id, username, password FROM %s WHERE username = "%s"',
            TABLE_USERS, $this->escapeString($username));

        $queryData = $this->fetchQuery($query);
        return $queryData[0];
    }

    public function addUser($username, $password) {
        $query = sprintf('INSERT INTO %s (user_id, username, password) VALUES(NULL, "%s", "%s")',
            TABLE_USERS, $this->escapeString($username), $this->escapeString($password));

        $this->query($query);
    }

    public function updateUsername($username, $userID) {
        $query = sprintf('UPDATE %s SET username = "%s" WHERE user_id = %d',
            TABLE_USERS, $this->escapeString($username), $userID);

        $this->query($query);
    }

    public function updatePassword($password, $userID) {
        $query = sprintf('UPDATE %s SET password = "%s" WHERE user_id = %d',
            TABLE_USERS, $this->escapeString($password), $userID);

        $this->query($query);
    }

    public function deleteAccount($userID) {
        $queries = array();
        $queries[] = sprintf('DELETE FROM %s WHERE user_id = %d', TABLE_MESSAGES, $userID);
        $queries[] = sprintf('DELETE FROM %s WHERE user_id = %d', TABLE_USERS, $userID);

        foreach($queries as $query) {
            $this->query($query);
        }
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
            VALUES(NULL, %d, "%s", "%s")', TABLE_PERSISTENT_LOGIN_TOKENS, $userID,
            date('Y-m-d H:i:s'), getHash($token));

        $this->query($query);
    }

    public function deletePersistentLogin() {
        if($data = $this->getPersistentLogin()) {
            $this->deletePersistentLoginToken($data['token_id']);
        }

        setcookie(COOKIE_PERSISTENT_LOGIN, '', time() - 3600);
    }

    /*public function getExpiredTokens() {
        $query = sprintf('SELECT token_id, creation_date FROM %s
            WHERE creation_date < "%s" - INTERVAL %d DAY',
            TABLE_PERSISTENT_LOGIN_TOKENS, date('Y-m-d H:i:s'),
            PERSISTENT_LOGIN_DAYS);

        return $this->fetchQuery($query);
    }*/

    private function getPersistentLogin() {
        if($_COOKIE[COOKIE_PERSISTENT_LOGIN]) {
            list($userID, $token) = explode('.', $_COOKIE[COOKIE_PERSISTENT_LOGIN]);

            $query = sprintf('SELECT token_id, token, users.user_id, username
                FROM %s AS users, %s AS tokens
                WHERE tokens.creation_date > "%s" - INTERVAL %d DAY
                AND tokens.user_id = %d AND tokens.user_id = users.user_id
                ORDER BY tokens.creation_date DESC',
                TABLE_USERS, TABLE_PERSISTENT_LOGIN_TOKENS,
                date('Y-m-d H:i:s'), PERSISTENT_LOGIN_DAYS,
                $this->escapeString($userID));

            foreach($this->fetchQuery($query) as $row) {
                if($row['token'] == getHash($token, $row['token'])) {
                    return $row;
                }
            }
        }
    }

    private function deletePersistentLoginToken($tokenID) {
        $query = sprintf('DELETE FROM %s WHERE token_id = %d', TABLE_PERSISTENT_LOGIN_TOKENS, $tokenID);
        $this->query($query);
    }

    private function getSessionUser() {
        return array('user_id' => $_SESSION[SESSION_USER_ID],
            'username' => $_SESSION[SESSION_USERNAME]);
    }
}

?>
