<?php

require 'vendor/autoload.php';

//when routing you'd replace echo with include

//route on $_GET['r']
echo route(array(
    null => 'home.php',
    'contact' => 'contact.php'));

print ', ';

//use a base path
echo 'src/purple/routes/' . route(array(
    null => 'word-list.php',
    'about' => 'about.php'));

print ', ';

//route on a POST variable
echo route(array(
    null => 'one.php',
    'two' => 'two.php'),
    $_POST['r']);

print ', ';

//route on some value for testing
echo route(array(
    null => 'home.php',
    'chess' => 'chess.php',
    'golf' => 'golf.php'),
    'golf');

?>
