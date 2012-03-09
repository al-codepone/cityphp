<?php

require_once(CITY_PHP . 'IView.php');

class TextView implements IView {
    private $text;

    public function __construct($text) {
        $this->text = $text;
    }

    public function draw() {
        return sprintf('<div>%s</div>', $this->text);
    }
}

?>
