<?php

function bcryptHash($input, $salt) {
    if(is_int($salt)) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ./';
        $numChars = strlen($chars);
        $salt = sprintf('$2a$%02d$', $salt);

        for($i = 0; $i < 22; ++$i) {
            $salt .= $chars[mt_rand(0, $numChars - 1)];
        }
    }

    return crypt($input, $salt);
}

?>
