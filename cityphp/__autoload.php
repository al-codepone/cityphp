<?php

function __autoload($className) {
    $vendors = preg_split('/\s+/', VENDOR);

    foreach($vendors as $v) {
        $filename = $v
            . str_replace('\\', DIRECTORY_SEPARATOR, ltrim($className, '\\'))
            . '.php';

        if(file_exists($filename)) {
            require_once $filename;
            break;
        }
    }
}

?>
