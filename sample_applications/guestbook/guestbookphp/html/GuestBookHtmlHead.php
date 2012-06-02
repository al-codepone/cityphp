<?php

require_once(CITY_PHP . 'html/HtmlHead.php');

class GuestBookHtmlHead extends HtmlHead {
    public function draw() {
        return sprintf('<head><meta charset="utf-8"/>
            <link type="text/css" rel="stylesheet" href="%sstyles.css"/>%s</head>',
            CSS, $this->getTags());
    }
}

?>
