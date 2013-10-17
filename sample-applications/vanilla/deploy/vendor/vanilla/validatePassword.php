<?php

require_once VANILLA . 'invalidPassword.php';
require_once VANILLA . 'isPassword.php';

function validatePassword($value, $inputName) {
    if(!isPassword($value)) {
        return invalidPassword($inputName);
    }
}

?>
