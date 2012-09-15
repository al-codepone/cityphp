<?php

session_start();

require_once('./constants.php');
require_once(VANILLA . 'database/MyModelFactory.php');

$userModel = MyModelFactory::getModel('UserModel');
$userModel->deletePersistentLogin();
unset($_SESSION[SESSION_USER_ID]);
header('Location:' . ROOT);
exit();

?>
