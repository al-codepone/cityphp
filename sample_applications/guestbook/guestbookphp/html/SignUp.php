<?php

require_once(GUEST_BOOK_PHP . 'html/error.php');
require_once(GUEST_BOOK_PHP . 'html/input.php');

function signUp($formData, $error = '') {
    return sprintf('%s<form action="%s" method="post">%s%s'
        . '<div><input type="submit" value="Sign Up"/></div></form>',
        error($error), SIGN_UP, input('Username', 'username', $formData['username']),
        input('Password', 'password', $formData['password'], 'password'));
}

?>
