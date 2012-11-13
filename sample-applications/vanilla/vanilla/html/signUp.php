<?php

require_once(STD_LIB . 'html/error.php');
require_once(STD_LIB . 'html/input.php');

function signUp($formData, $error = '') {
    return sprintf('<form method="post">%s%s%s%s'
        . '<div><input type="submit" value="Sign Up"/></div></form>',
        error($error),
        input('Username', 'username', $formData['username']),
        input('Email', 'email', $formData['email'], 'email'),
        input('Password', 'password', $formData['password'], 'password'));
}

?>
