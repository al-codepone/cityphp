<?php

require_once(VANILLA . 'html/error.php');
require_once(VANILLA . 'html/input.php');

function forgotPassword($formData, $error = '') {
    return sprintf('%s<form action="%s" method="post">%s'
        . '<div><input type="submit" value="Submit"/></div></form>',
        error($error), FORGOT_PASSWORD,
        input('Email', 'email', $formData['email'], 'email'));
}

?>
