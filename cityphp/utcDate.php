<?php

function utcDate() {
    date_default_timezone_set('UTC');
    return date('Y-m-d');
}

?>
