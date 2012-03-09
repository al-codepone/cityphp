<?php

require_once(CITY_PHP . 'IView.php');

class HelloWorldHtmlBody implements IView {
    public function draw() {
        return '<body>hello world</body>';
    }
}

?>
