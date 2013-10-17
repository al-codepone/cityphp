<?php

namespace vanilla\database;

require_once CITYPHP . 'sha1Token.php';

use cityphp\database\DatabaseHandle;
use vanilla\database\ModelFactory;

class ResetPasswordModel extends TokenModel {
    public function __construct(DatabaseHandle $databaseHandle) {
        parent::__construct($databaseHandle, TABLE_RESET_PASSWORD_TOKENS, TTL_RESET_PASSWORD);
    }

    public function createToken($email) {
        $userModel = ModelFactory::get('vanilla\database\UserModel');
        $userData = $userModel->getUserWithEmail($email);

        if($userData) {
            $token = sha1Token();
            $subject = 'Reset Your Password';
            $additionalHeaders = sprintf("From: %s\r\n", EMAIL_FROM);
            $message = sprintf("%s,\n\nUse this link to reset your password:\n\n%s%s%d/%s",
                $userData['username'], SITE, RESET_PASSWORD, $userData['user_id'], $token);

            parent::createToken($userData['user_id'], $token);
            mail($email, $subject, $message, $additionalHeaders);
        }
    }

    public function getToken($userID, $token) {
        return parent::getToken($userID, $token);
    }

    public function deleteToken($tokenID) {
        parent::deleteToken($tokenID);
    }
}

?>
