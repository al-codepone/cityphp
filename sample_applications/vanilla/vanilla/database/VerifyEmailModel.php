<?php

require_once(VANILLA . 'database/TokenModel.php');

class VerifyEmailModel extends TokenModel {
    public function __construct(DatabaseHandle $databaseHandle) {
        parent::__construct($databaseHandle, TABLE_VERIFY_EMAIL_TOKENS);
    }

    public function createToken($userID, $token, $email) {
        parent::createToken($userID, $token, $email);
    }

    public function getToken($userID, $token) {
        return parent::getToken($userID, $token);
    }

    public function deleteToken($tokenID) {
        parent::deleteToken($tokenID);
    }
}

?>
