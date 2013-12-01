<?php

require_once 'const.php';
require_once CITYPHP . '__autoload.php';

use purple\db\ModelFactory2;

header('Content-Type:application/json');
ModelFactory2::$isJson = true;
$wordModel = ModelFactory2::get('purple\db\WordModel');

$wordModel->install();
$wordModel->create(array('book', 'curtain', 'lawn'));

echo json_encode(array(
    'success' => true,
    'payload' => $wordModel->get()));

?>
