<?php

require_once(CITY_PHP . 'IView.php');

class GuestBookHtmlBody implements IView {
    private $user;
    private $content;

    public function __construct($user, IView $content) {
        $this->user = $user;
        $this->content = $content;
    }

    public function draw() {
        return sprintf('<body><div id="main">%s%s</div></body>',
            $this->getNavigation(),
            $this->getContent());
    }

    private function getNavigation() {
        $ob = '<div id="navigation"><ul>';

        if($this->user) {
            $ob .= sprintf('<li><a href="%s">%s</a></li>
                <li><a href="%s">home</a></li>
                <li><a href="%s">settings</a></li>
                <li><a href="%s">log out</a></li>',
                ROOT . $this->user['username'], $this->user['username'],
                ROOT, SETTINGS, LOG_OUT);
        }
        else {
            $ob .= sprintf('<li><a href="%s">home</a></li>
                <li><a href="%s">sign up</a></li>
                <li><a href="%s">login</a></li>',
                ROOT, SIGN_UP, LOGIN);
        }

        $ob .= '</ul></div>';
        return $ob;
    }

    private function getContent() {
        return sprintf('<div id="content">%s</div>',
            $this->content->draw());
    }
}

?>
