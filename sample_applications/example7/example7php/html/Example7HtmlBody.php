<?php

require_once(CITY_PHP . 'html/HtmlBody.php');
require_once(CITY_PHP . 'IView.php');

class Example7HtmlBody extends HtmlBody {
    private $view;

    public function __construct($bodyTag, IView $view) {
        parent::__construct($bodyTag);
        $this->view = $view;
    }

    public function draw() {
        return sprintf('%s<div>%s%s</div></body>',
           $this->getBodyTag(),
           $this->getNavigation(),
           $this->view->draw());
    }

    private function getNavigation() {
        $ob = '<div><ul id="navigation">';
        $titles = array('Home', 'Gallery', 'Contact');
        $scripts = array('', 'gallery.php', 'contact.php');

        foreach($titles as $i => $title) {
            $ob .= sprintf('<li><a href="%s%s">%s</a></li>',
               ROOT, $scripts[$i], $title);
        }

        $ob .= '</ul></div>';
        return $ob;
    }
}

?>
