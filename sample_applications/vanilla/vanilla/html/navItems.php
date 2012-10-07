<?php

function navItems($user) {
    return $user 
        ? sprintf('<li><a href="%s">home</a></li>
            <li><a href="%s">settings</a></li>
            <li><a href="%s">log out</a></li>
            <li>%s</li>',
            ROOT, SETTINGS, LOG_OUT, $user['username'])

        : sprintf('<li><a href="%s">home</a></li>
            <li><a href="%s">sign up</a></li>
            <li><a href="%s">log in</a></li>',
            ROOT, SIGN_UP, LOGIN);
}

?>
