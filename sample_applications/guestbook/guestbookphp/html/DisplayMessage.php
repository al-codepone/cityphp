<?php

require_once(CITY_PHP . 'IView.php');

class DisplayMessage implements IView {
    private $message;

    public function __construct($message) {
        $this->message = $message;
    }

    public function draw() {
        return sprintf('<div>%s</div>', $this->message);
    }
}

?>
