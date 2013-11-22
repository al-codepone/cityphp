<?php

require_once 'const.php';
require_once CITYPHP . '__autoload.php';

use vanilla\database\ModelFactory;

$modelNames = array(
    'vanilla\database\LoginModel',
    'vanilla\database\VerifyEmailModel',
    'vanilla\database\ResetPasswordModel');

foreach($modelNames as $modelName) {
    $model = ModelFactory::get($modelName);
    $model->prune();
}

echo 'prune successful';

?>
