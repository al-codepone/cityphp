<?php

//include composer autoload
require 'vendor/autoload.php';

//use a class from the project package
$monster = new purple\Monster();

//use a function from cityphp
$token = sha1Token();

echo
    $token,
    ', ',
    $monster->talk();

?>
