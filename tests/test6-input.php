<?php

require 'vendor/autoload.php';

echo implode("\n\n", array(
    input(),

    input(array('id' => 'username')),

    input(array('id' => 'email'), 'Email'),

    input(
        array('id' => 'city'),
        'City',
        false,
        array('style' => 'color:pink;')),
 
    input(
        array('name' => 'zip'),
        'Zip Code',
        true,
        array('style' => 'color:pink;'),
        array(
            'style' => 'background:#000000;',
            'onclick' => 'alert("container");'))));

?>
