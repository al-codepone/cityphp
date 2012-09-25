<?php

function sha1Token() {
    return sha1(uniqid(mt_rand(), true));
}

?>
