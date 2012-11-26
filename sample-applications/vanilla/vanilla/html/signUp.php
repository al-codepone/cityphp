<?php

require_once(CITYPHP . 'html/error.php');
require_once(CITYPHP . 'html/input.php');

function signUp($formData, $error = '') {
    ob_start(); ?>

<form method="post">
    <?=error($error)?>
    <?=input('Username', 'username', $formData['username'])?>
    <?=input('Email(optional)', 'email', $formData['email'], 'email')?>
    <?=input('Password', 'password', $formData['password'], 'password')?>
    <?=input('Confirm Password', 'confirm_password', $formData['confirm_password'], 'password')?>
    <div><input type="submit" value="Sign Up"/></div>
</form>

    <?php return ob_get_clean();
}

?>
