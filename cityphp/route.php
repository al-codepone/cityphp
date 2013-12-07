<?php

function route(array $array, $key = false) {
    $key = ($key === false) ? $_GET['r'] : $key;
    return $array[$key];
}

?>
