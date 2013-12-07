<?php

require_once 'const.php';
require_once CITYPHP . '__autoload.php';
require_once CITYPHP . 'route.php';
require_once VANILLA . 'html/navItems.php';

use vanilla\db\ModelFactory;

session_name(SESSION_NAME);
session_start();

$userModel = ModelFactory::get('vanilla\db\UserModel');
$loginModel = ModelFactory::get('vanilla\db\LoginModel');
$user = $loginModel->getActiveUser();

include VANILLA . 'routes/' . route(array(
    null => 'home.php',
    'signup' => 'sign-up.php',
    'login' => 'login.php',
    'edit-account' => 'edit-account.php',
    'verify-email' => 'verify-email.php',
    'forgot-password' => 'forgot-password.php',
    'reset-password' => 'reset-password.php'));

$navItems = navItems($user);
include VANILLA . 'html/template.php';

?>
