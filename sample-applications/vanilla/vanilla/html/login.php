<?php

require_once(VANILLA . 'html/checkbox.php');
require_once(VANILLA . 'html/error.php');
require_once(VANILLA . 'html/input.php');

function login($formData, $error = '') {
    ob_start(); ?>

<form method="post">
    <?=error($error)?>
    <?=input('Username', 'username', $formData['username'])?>
    <?=input('Password', 'password', $formData['password'], 'password')?>
    <?=checkbox('Remember Me', 'remember_me', 'remember_me', $formData['remember_me'])?>
    <div><a href="<?=FORGOT_PASSWORD?>">forgot password</a></div>
    <div><input type="submit" value="Log In"/></div>
</form>

    <?php return ob_get_clean();
}

?>
