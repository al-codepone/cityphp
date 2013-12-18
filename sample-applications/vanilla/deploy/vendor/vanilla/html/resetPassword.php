<?php

require_once CITYPHP . 'html/blist.php';
require_once CITYPHP . 'html/input.php';

function resetPassword(array $formData, $errors = array()) {
    ob_start(); ?>

<form method="post">
    <div>Use this form to reset your password.</div>
    <?=blist($errors, array('class' => 'error'))?>

    <?=input(array(
        'id' => 'password',
        'type' => 'password'),
        'New Password')?>

    <?=input(array(
        'id' => 'confirm_password',
        'type' => 'password'),
        'Confirm New Password')?>

    <div><input type="submit" value="Reset"/></div>
</form>

    <? return ob_get_clean();
}

?>
