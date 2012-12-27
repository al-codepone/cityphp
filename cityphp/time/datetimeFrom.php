<?php

function datetimeFrom($datetime, $timezone) {
    $date = new DateTime($datetime, new DateTimeZone($timezone)); 
    date_default_timezone_set('UTC'); 
    return date('Y-m-d H:i:s', $date->format('U'));
}

?>
