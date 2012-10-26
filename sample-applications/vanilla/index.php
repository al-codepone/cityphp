<?php

session_start();

require_once('./constants.php');
require_once(CITYPHP . 'route.php');
require_once(VANILLA . 'database/MyModelFactory.php');
require_once(VANILLA . 'html/navItems.php');

$userModel = MyModelFactory::getModel('UserModel');
$loginModel = MyModelFactory::getModel('LoginModel');
$user = $loginModel->getActiveUser();

include(route(array(
    null => 'home.php',
    'signup' => 'sign-up.php',
    'login' => 'login.php',
    'settings' => 'settings.php',
    'verify-email' => 'verify-email.php',
    'forgot-password' => 'forgot-password.php',
    'reset-password' => 'reset-password.php')));

$navItems = navItems($user);
include(VANILLA . 'html/template.php');

?>
