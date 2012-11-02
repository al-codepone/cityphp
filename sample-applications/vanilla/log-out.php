<?php

session_start();

require_once('./constants.php');
require_once(VANILLA . 'database/MyModelFactory.php');

$loginModel = MyModelFactory::getModel('LoginModel');
$loginModel->logOut();
header('Location:' . ROOT);
exit();

?>
