<?php

class MessageData {
    public $message_id;
    public $creation_date;
    public $message;

    public function __construct($message_id = -1,
                                $creation_date = 0,
                                $message = '') {
        $this->message_id = $message_id;
        $this->creation_date = $creation_date;
        $this->message = $message;
    }
}

?>
