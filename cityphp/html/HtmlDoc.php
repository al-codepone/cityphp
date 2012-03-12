<?php

require_once(CITY_PHP . 'IView.php');

class HtmlDoc implements IView {
    private $head;
    private $body;

    public function __construct(IView $head, IView $body) {
        $this->head = $head;
        $this->body = $body;
    }

    public function draw() {
        return sprintf('<!DOCTYPE html><html>%s%s</html>',
            $this->getHead()->draw(),
            $this->getBody()->draw());
    }

    protected function getHead() {
        return $this->head;
    }

    protected function getBody() {
        return $this->body;
    }
}

?>
