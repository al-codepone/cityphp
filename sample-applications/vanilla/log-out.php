<?php

require_once('./constants.php');
require_once(VANILLA . 'database/ModelFactory.php');

session_name(SESSION_NAME);
session_start();

$loginModel = ModelFactory::get('LoginModel');
$loginModel->logOut();
header('Location:' . ROOT);
exit();

?>
