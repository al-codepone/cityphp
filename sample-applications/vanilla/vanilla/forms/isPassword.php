<?php

function isPassword($value) {
    return preg_match('/^.{6,100}$/', $value);
}

?>
