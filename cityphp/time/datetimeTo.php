<?php

function datetimeTo($datetime, $timezone, $format) {
    $date = new DateTime($datetime, new DateTimeZone('UTC')); 
    date_default_timezone_set($timezone); 
    return date($format, $date->format('U'));
}
 
?>
