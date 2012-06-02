<?php

require_once(CITY_PHP . 'IView.php');

class Home implements IView {
    private $user;
    private $messageList;
    private $pagination;
    private $error;

    public function __construct($user,
                                MessageList $messageList,
                                Pagination $pagination,
                                $error) {
        $this->user = $user;
        $this->messageList = $messageList;
        $this->pagination = $pagination;
        $this->error = $error;
    }

    public function draw() {
        $top = $this->user
            ? $this->getForm()
            : '<div>Please login to post messages.</div>';

        return $top
            . $this->messageList->draw()
            . $this->pagination->draw();
    }

    private function getForm() {
        ob_start();
        print '<div>';

        if($this->error) {
            printf('<div class="error">%s</div>', $this->error);
        }

?>
<form action="<?=ROOT?>" method="post">
    <div><textarea name="xmessage" id="xmessage"></textarea></div>
    <div><input type="submit" value="Post"/></div>
</form></div>
<?php

        return ob_get_clean();
    }
}

?>
