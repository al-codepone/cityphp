<?php

require_once(CITY_PHP . 'IView.php');

class Message implements IView {
    private $message;

    public function __construct(array $message) {
        $this->message = $message;
    }

    public function draw() {
        return sprintf('<div class="lonemessage">
            <div><a href="%s%s">%s</a> on %s</div><div>%s</div></div>',
            USER, $this->message['username'], $this->message['username'],
            date('M j, Y', strtotime($this->message['creation_date'])),
            htmlspecialchars($this->message['message']));
    }
}

?>
