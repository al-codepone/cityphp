<?php

require_once(CITYPHP . 'html/checkbox.php');
require_once(CITYPHP . 'html/error.php');
require_once(CITYPHP . 'html/input.php');

function login($formData, $error = '') {
    ob_start(); ?>

<form method="post">
    <?=error($error)?>
    <?=input('Username', 'username', $formData['username'])?>
    <?=input('Password', 'password', $formData['password'], 'password')?>
    <?=checkbox('Remember Me', 'remember_me', 'remember_me', 1, $formData['remember_me'])?>
    <div><a href="<?=FORGOT_PASSWORD?>">forgot password</a></div>
    <div><input type="submit" value="Log In"/></div>
</form>

    <?php return ob_get_clean();
}

?>
