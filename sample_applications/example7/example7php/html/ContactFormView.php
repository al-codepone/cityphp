<?php

require_once(CITY_PHP . 'IView.php');

class ContactFormView implements IView {
    public function draw() {
        ob_start();

?>
<div><form action="<?php echo CONTACT; ?>" method="post">
    <div>Name<br/><input type="text" id="xname"/></div>
    <div>Email<br/><input type="email"/></div>
    <div>Message<br/><textarea></textarea></div>
    <div><input type="submit" value="Send"/></div>
</form></div>
<?php

        $ob = ob_get_contents();
        ob_end_clean();
        return $ob;
    }
}

?>
