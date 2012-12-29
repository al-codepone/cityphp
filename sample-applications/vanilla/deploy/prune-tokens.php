<?php

require_once('./constants.php');
require_once(VANILLA . 'database/ModelFactory.php');

$modelNames = array(
    'LoginModel',
    'VerifyEmailModel',
    'ResetPasswordModel');

foreach($modelNames as $modelName) {
    $model = ModelFactory::get($modelName);
    $model->prune();
}

echo 'prune successful';

?>
