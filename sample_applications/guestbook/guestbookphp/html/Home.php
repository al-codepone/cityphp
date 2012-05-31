<?php

require_once(CITY_PHP . 'IView.php');

class Home implements IView {
    private $user;
    private $messageList;
    private $pagination;
    private $formError;

    public function __construct($user, IView $messageList,
                                IView $pagination, $formError) {
        $this->user = $user;
        $this->messageList = $messageList;
        $this->pagination = $pagination;
        $this->formError = $formError;
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

        if($this->formError) {
            printf('<div class="error">%s</div>', $this->formError);
        }

?>
<form action="<?=ROOT?>" method="post">
    <div><textarea name="xmessage" id="xmessage"></textarea></div>
    <div><input type="submit" value="Post"/></div>
</form></div>
<?php

        $ob = ob_get_contents();
        ob_end_clean();
        return $ob;
    }
}

?>
