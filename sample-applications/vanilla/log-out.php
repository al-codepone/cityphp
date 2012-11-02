<?php

require_once('./constants.php');
require_once(VANILLA . 'database/MyModelFactory.php');

session_name(SESSION_NAME);
session_start();

$loginModel = MyModelFactory::getModel('LoginModel');
$loginModel->logOut();
header('Location:' . ROOT);
exit();

?>
