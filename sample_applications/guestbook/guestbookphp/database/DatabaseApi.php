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
        $query = sprintf('CREATE TABLE %s (
            message_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
            creation_date INT UNSIGNED NOT NULL DEFAULT 0,
            message TEXT NOT NULL DEFAULT "",
            PRIMARY KEY (message_id))
            ENGINE = MYISAM',
            TABLE_MESSAGES);

        $this->query($query);
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

    public function addMessage($message) {
        $query = sprintf('INSERT INTO %s (message_id, creation_date, message) VALUES(NULL, %d, "%s")',
            TABLE_MESSAGES, time(), $this->escapeString($message));

        $this->query($query);
    }

    private function getMessageData(array $data) {
        return new MessageData($data['message_id'], $data['creation_date'], $data['message']);
    }
}

?>
