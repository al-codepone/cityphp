<?php

require_once('./constants.php');
require_once(CITYPHP . 'route.php');
require_once(VANILLA . 'database/ModelFactory.php');
require_once(VANILLA . 'html/navItems.php');

session_name(SESSION_NAME);
session_start();

$userModel = ModelFactory::get('UserModel');
$loginModel = ModelFactory::get('LoginModel');
$user = $loginModel->getActiveUser();

include(route(array(
    null => 'home.php',
    'signup' => 'sign-up.php',
    'login' => 'login.php',
    'edit-account' => 'edit-account.php',
    'verify-email' => 'verify-email.php',
    'forgot-password' => 'forgot-password.php',
    'reset-password' => 'reset-password.php'),
    VANILLA . 'routes/'));

$navItems = navItems($user);
include(VANILLA . 'html/template.php');

?>
