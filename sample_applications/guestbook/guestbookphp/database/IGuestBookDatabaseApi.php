<?php

interface IGuestBookDatabaseApi {
    const TABLE_MESSAGES = 'messages';

    public function install();
    public function getNumMessages();
    public function getMessage($messageID);
    public function getMessages($pageNum);
    public function addMessage($message);
}

?>
