<?php

require_once CITYPHP . 'html/input.php';
require_once CITYPHP . 'html/ulist.php';

function resetPassword($formData, $errors = array()) {
    ob_start(); ?>

<form method="post">
    <div>Use this form to reset your password.</div>
    <?=ulist($errors, array('class' => 'error'))?>

    <?=input(array(
        'id' => 'password',
        'value' => $formData['password'],
        'type' => 'password'),
        'New Password')?>

    <?=input(array(
        'id' => 'confirm_password',
        'value' => $formData['confirm_password'],
        'type' => 'password'),
        'Confirm New Password')?>

    <div><input type="submit" value="Reset"/></div>
</form>

    <? return ob_get_clean();
}

?>
