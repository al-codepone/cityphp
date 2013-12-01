<?php

require_once 'const.php';
require_once CITYPHP . '__autoload.php';

use purple\db\ModelFactory;

//must use full namespace
$wordModel = ModelFactory::get('purple\db\WordModel');

$wordModel->install();
$wordModel->create(array('red', 'swim', 'apple', 'red'));
$wordModel->update('red', 'coal');
$wordModel->delete('swim');

var_dump($wordModel->get());

?>
