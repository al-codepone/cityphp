<?php

require_once(VANILLA . 'html/error.php');
require_once(VANILLA . 'html/input.php');

function login($formData, $error = '') {
    return sprintf('%s<form action="%s" method="post">%s%s'
        . '<div><input type="checkbox" name="rememberme"/>Remember Me</div>'
        . '<div><input type="submit" value="Log In"/></div></form>',
        error($error), LOGIN, input('Username', 'username', $formData['username']),
        input('Password', 'password', $formData['password'], 'password'));
}

?>
