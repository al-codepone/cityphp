<?php

require_once CITYPHP . 'html/input.php';
require_once CITYPHP . 'html/ulist.php';

function signUp($formData, $errors = array()) {
    ob_start(); ?>

<form method="post">
    <?=ulist($errors, array('class' => 'error'))?>
    <?=input(array('id' => 'username', 'value' => $formData['username']), 'Username')?>
    <?=input(array('id' => 'email', 'value' => $formData['email'], 'type' => 'email'), 'Email(optional)')?>
    <?=input(array('id' => 'password', 'value' => $formData['password'], 'type' => 'password'), 'Password')?>
    <?=input(array('id' => 'confirm_password', 'value' => $formData['confirm_password'], 'type' => 'password'), 'Confirm Password')?>
    <div><input type="submit" value="Sign Up"/></div>
</form>

    <?php return ob_get_clean();
}

?>
