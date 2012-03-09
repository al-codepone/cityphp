<?php

require_once(CITY_PHP . 'IView.php');
require_once(GUEST_BOOK_PHP . 'database/MessageData.php');

abstract class MessageHtmlBody implements IView {
    private $messageData;

    public function __construct(MessageData $messageData) {
        $this->messageData = $messageData;
    }

    protected function getMessageData() {
        return $this->messageData;
    }
}

?>
