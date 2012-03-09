<?php

require_once(CITY_PHP . 'html/HtmlDoc.php');

class MyHtmlDoc extends HtmlDoc {
    public function draw() {
        return '<!DOCTYPE html><html lang="en">'
            . $this->getHead()->draw()
            . $this->getBody()->draw()
            . '</html>';
    }
}

?>
