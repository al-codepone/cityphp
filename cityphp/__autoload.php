<?php

function __autoload($className) {
    require_once VENDOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
}

?>
