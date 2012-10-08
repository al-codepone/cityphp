<?php

require_once(VANILLA . 'html/error.php');
require_once(VANILLA . 'html/input.php');

function login($formData, $error = '') {
    ob_start(); ?>

<form method="post">
    <?=error($error)?>
    <?=input('Username', 'username', $formData['username'])?>
    <?=input('Password', 'password', $formData['password'], 'password')?>
    <div>
        <input type="checkbox" id="rememberme" name="rememberme"
        /><label for="rememberme">Remember Me</label>
    </div>
    <div><a href="<?=FORGOT_PASSWORD?>">forgot password</a></div>
    <div><input type="submit" value="Log In"/></div>
</form>

    <?php return ob_get_clean();
}

?>
