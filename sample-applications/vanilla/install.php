<?php

require_once('./constants.php');
require_once(VANILLA . 'database/ModelFactory.php');

$modelNames = array(
    'LoginModel',
    'UserModel',
    'VerifyEmailModel',
    'ResetPasswordModel');

foreach($modelNames as $modelName) {
    $model = ModelFactory::get($modelName);
    $model->install();
}

printf('Install successful. Visit the <a href="%s">home page</a>.', ROOT);

?>
