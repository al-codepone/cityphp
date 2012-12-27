<?php

function datetimeNow() {
    date_default_timezone_set('UTC');
    return date('Y-m-d H:i:s');
}

?>
