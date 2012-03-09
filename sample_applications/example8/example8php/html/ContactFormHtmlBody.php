<?php

require_once(CITY_PHP . 'html/HtmlBody.php');

class ContactFormHtmlBody extends HtmlBody {
    private $formValues;
    private $errorMessage;

    public function __construct($bodyTag, array $formValues, $errorMessage = '') {
        parent::__construct($bodyTag);
        $this->formValues = $formValues;
        $this->errorMessage = $errorMessage;
    }

    public function draw() {
        ob_start();
        printf('%s<div>', $this->getBodyTag());

        if($this->errorMessage != '') {
            printf('<div class="error">%s</div>', $this->errorMessage);
        }

?>
<form action="<?php echo ROOT; ?>" method="post">
    <div>Name<br/><input type="text" name="xname" id="xname" value="<?php $this->shrink('xname'); ?>"/></div>
    <div>Email<br/><input type="email" name="xemail" value="<?php $this->shrink('xemail'); ?>"/></div>
    <div>Message<br/><textarea name="xmessage"><?php $this->shrink('xmessage'); ?></textarea></div>
    <div><input type="submit" value="Send"/></div>
</form></div></body>
<?php

        $ob = ob_get_contents();
        ob_end_clean();
        return $ob;
    }

    private function shrink($key) {
        print htmlspecialchars($this->formValues[$key]);
    }
}

?>
