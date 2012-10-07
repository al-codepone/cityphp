<?php

require_once(VANILLA . 'html/error.php');
require_once(VANILLA . 'html/input.php');

function login($formData, $error = '') {
    return sprintf('<form method="post">%s%s%s'
        . '<div><input type="checkbox" name="rememberme"/>Remember Me</div>'
        . '<div><a href="%s">forgot password</a></div>'
        . '<div><input type="submit" value="Log In"/></div></form>',
        error($error),
        input('Username', 'username', $formData['username']),
        input('Password', 'password', $formData['password'], 'password'),
        FORGOT_PASSWORD);
}

?>
