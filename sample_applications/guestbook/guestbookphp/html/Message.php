<?php

require_once(CITY_PHP . 'IView.php');

class Message implements IView {
    private $message;

    public function __construct(array $message) {
        $this->message = $message;
    }

    public function draw() {
        return sprintf('<div class="lonemessage"><span>%s</span>%s</div>',
            date('M j, Y', strtotime($this->message['creation_date'])),
            htmlspecialchars($this->message['message']));
    }
}

?>
