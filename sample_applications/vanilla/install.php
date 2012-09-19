<?php

require_once('./constants.php');
require_once(VANILLA . 'database/MyModelFactory.php');

$userModel = MyModelFactory::getModel('UserModel');
$loginModel = MyModelFactory::getModel('LoginModel');
$userModel->install();
$loginModel->install();

printf('Install successful. Visit the <a href="%s">home page</a>.', ROOT);

?>
