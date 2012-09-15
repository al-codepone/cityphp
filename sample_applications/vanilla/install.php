<?php

require_once('./constants.php');
require_once(VANILLA . 'database/MyModelFactory.php');

$userModel = MyModelFactory::getModel('UserModel');
$userModel->install();

printf('Install successful. Visit the <a href="%s">home page</a>.', ROOT);

?>
