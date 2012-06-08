<?php

function getHash($input, $salt = NULL) {
    if(is_null($salt)) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ./';
        $numChars = strlen($chars);
        $salt = '$2a$12$';

        for($i = 0; $i < 22; ++$i) {
            $salt .= $chars[mt_rand(0, $numChars - 1)];
        }
    }

    return crypt($input, $salt);
}

function getRoute(array $routes, $key = 'r') {
    foreach($routes as $route => $script) {
        if($route == $_GET[$key]) {
            return $script;
        }
    }
}

?>
