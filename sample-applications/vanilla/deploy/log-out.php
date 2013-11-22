<?php

require_once 'const.php';
require_once CITYPHP . '__autoload.php';

use vanilla\database\ModelFactory;

session_name(SESSION_NAME);
session_start();

$loginModel = ModelFactory::get('vanilla\database\LoginModel');
$loginModel->logOut();
header('Location:' . ROOT);
exit();

?>
