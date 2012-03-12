<?php

require_once(CITY_PHP . 'IView.php');

class HtmlHead implements IView {
    private $tags;

    public function __construct(array $tags = array()) {
        $this->tags = implode('', $tags);
    }

    public function draw() {
        return sprintf('<head>%s</head>', $this->getTags());
    }

    protected function getTags() {
        return $this->tags;
    }
}

?>
