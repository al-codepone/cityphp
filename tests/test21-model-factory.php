<?php

require 'const.php';
require 'vendor/autoload.php';

use purple\db\ModelFactory;

//must pass full namespace to get()
$wordModel = ModelFactory::get('purple\db\WordModel');

$wordModel->install();
$wordModel->create(array('red', 'swim', 'apple', 'red'));
$wordModel->update('red', 'coal');
$wordModel->delete('swim');

var_dump($wordModel->get());

?>
