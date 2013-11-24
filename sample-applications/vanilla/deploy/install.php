<?php

require_once 'const.php';
require_once CITYPHP . '__autoload.php';

use vanilla\db\ModelFactory;

$modelNames = array(
    'vanilla\db\LoginModel',
    'vanilla\db\UserModel',
    'vanilla\db\VerifyEmailModel',
    'vanilla\db\ResetPasswordModel');

foreach($modelNames as $modelName) {
    $model = ModelFactory::get($modelName);
    $model->install();
}

printf('Install successful. Visit the <a href="%s">home page</a>.', ROOT);

?>
