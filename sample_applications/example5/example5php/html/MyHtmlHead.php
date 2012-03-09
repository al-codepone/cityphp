<?php

require_once(CITY_PHP . 'html/HtmlHead.php');

class MyHtmlHead extends HtmlHead {
    public function draw() {
        return '<head>'
            . $this->getTags()
            . '<meta charset="utf-8"/>'
            . '</head>';
    }
}

?>
