<?php

//enable access to cityphp and project files
require 'vendor/autoload.php';

//use a function from cityphp
$token = sha1Token();

//use a class from cityphp
class Validator extends cityphp\forms\FormValidator {
    public function __construct() {
        parent::__construct(array(
            'username',
            'password'));
    }
}

$validator = new Validator();

//use a function from the project package
$thing = thing();

//use a class from the project package
$monster = new purple\Monster();

echo implode("<br/>\n", array(
    $token,
    print_r($validator->values(), true),
    $thing,
    $monster->talk()));

?>
