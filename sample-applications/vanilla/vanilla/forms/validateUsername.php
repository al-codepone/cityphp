<?php

function validateUsername($value) {
    if(!preg_match('/^[a-z0-9]{4,16}$/i', $value)) {
        return 'Invalid username';
    }
}

?>
