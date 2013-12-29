<?php

require 'const.php';
require 'vendor/autoload.php';

use purple\db\ModelFactory;

$wordModel = ModelFactory::get('purple\db\WordModel');

include 'src/purple/routes/' . route(array(
    null => 'word-list.php',
    'add' => 'add-word.php',
    'about' => 'about.php'));

include 'src/purple/html/template4.php';

?>
