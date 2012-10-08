<?php

require_once(VANILLA . 'html/error.php');
require_once(VANILLA . 'html/input.php');

function forgotPassword($formData, $error = '') {
    return sprintf('<form method="post">%s%s'
        . '<div><input type="submit" value="Submit"/></div></form>',
        error($error),
        input('Email', 'email', $formData['email'], 'email'));
}

?>