<?php

require_once('./constants.php');
require_once(VANILLA . 'database/MyModelFactory.php');

$modelNames = array(
    'LoginModel',
    'VerifyEmailModel',
    'ResetPasswordModel');

foreach($modelNames as $modelName) {
    $model = MyModelFactory::getModel($modelName);
    $model->prune();
}

echo 'prune successful';

?>
