<?php

require_once(CITY_PHP . 'database/MySqlDatabaseHandle.php');
require_once(GUEST_BOOK_PHP . 'database/MessageData.php');

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

        foreach($queries as $query) {
            $this->query($query);
        }
    }

    public function getNumMessages() {
        $query = sprintf('SELECT COUNT(*) AS count FROM %s', TABLE_MESSAGES);
        $queryData = $this->fetchQuery($query);
        return $queryData[0]['count'];
    }

    public function getMessage($messageID) {
        $query = sprintf('SELECT message_id, creation_date, message FROM %s WHERE message_id = %d',
            TABLE_MESSAGES, $messageID);

        $queryData = $this->fetchQuery($query);
        return (count($queryData) == 1) ? $this->getMessageData($queryData[0]) : new MessageData();
    }

    public function getMessages($pageNum) {
        $query = sprintf('SELECT message_id, creation_date, message FROM %s ORDER BY creation_date DESC LIMIT %d, %d',
            TABLE_MESSAGES, ($pageNum - 1)*MESSAGES_PER_PAGE, MESSAGES_PER_PAGE);

        $queryData = $this->fetchQuery($query);
        $messages = array();
        foreach($queryData as $data) {
            $messages[] = $this->getMessageData($data);
        }

        return $messages;
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

    public function getLoggedInUser() {
        if(isset($_SESSION[SESSION_USER_ID])) {
            return array('user_id' => $_SESSION[SESSION_USER_ID],
                         'username' => $_SESSION[SESSION_USERNAME]);
        }

        return NULL;
    }

    private function getMessageData(array $data) {
        return new MessageData($data['message_id'], $data['creation_date'], $data['message']);
    }
}

?>
