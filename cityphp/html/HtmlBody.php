<?php

require_once(CITY_PHP . 'IView.php');

abstract class HtmlBody implements IView {
    private $bodyTag;

    public function __construct($bodyTag = '<body>') {
        $this->bodyTag = $bodyTag;
    }

    protected function getBodyTag() {
        return $this->bodyTag;
    }
}

?>
