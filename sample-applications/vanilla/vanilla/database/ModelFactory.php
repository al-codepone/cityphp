<?php

require_once(CITYPHP . 'database/AdapterFactory.php');
require_once(CITYPHP . 'database/MySqlDatabaseHandle.php');
require_once(VANILLA . 'database/LoginModel.php');
require_once(VANILLA . 'database/ResetPasswordModel.php');
require_once(VANILLA . 'database/UserModel.php');
require_once(VANILLA . 'database/VerifyEmailModel.php');

class ModelFactory extends AdapterFactory {
    protected static function getDatabaseHandle() {
        return new MySqlDatabaseHandle(
            DATABASE_HOST,
            DATABASE_USERNAME,
            DATABASE_PASSWORD,
            DATABASE_NAME);
    }
}

?>
