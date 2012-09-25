<?php

require_once('./constants.php');
require_once(VANILLA . 'database/MyModelFactory.php');

$modelNames = array('LoginModel', 'UserModel', 'VerifyEmailModel');

foreach($modelNames as $modelName) {
    $model = MyModelFactory::getModel($modelName);
    $model->install();
}

printf('Install successful. Visit the <a href="%s">home page</a>.', ROOT);

?>
