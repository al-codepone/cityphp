<?php

require_once(CITY_PHP . 'IView.php');

class User implements IView {
    private $username;
    private $messageList;
    private $pagination;

    public function __construct($username,
                                MessageList $messageList,
                                Pagination $pagination) {
        $this->username = $username;
        $this->messageList = $messageList;
        $this->pagination = $pagination;
    }

    public function draw() {
        return sprintf('<div class="usertitle">%s</div>', $this->username)
           . $this->messageList->draw()
           . $this->pagination->draw();
    }
}

?>
