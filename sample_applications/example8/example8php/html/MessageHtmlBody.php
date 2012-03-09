<?php

require_once(CITY_PHP . 'IView.php');

class MessageHtmlBody implements IView {
    private $message;

    public function __construct($message) {
        $this->message = $message;
    }

    public function draw() {
        return sprintf('<body>%s</body>', $this->message);
    }
}

?>
