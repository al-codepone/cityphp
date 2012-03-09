<?php

require_once(CITY_PHP . 'IView.php');

class SingleViewHtmlBody implements IView {
    private $view;

    public function __construct(IView $view) {
        $this->view = $view;
    }

    public function draw() {
        return sprintf('<body>%s</body>', $this->view->draw());
    }
}

?>
