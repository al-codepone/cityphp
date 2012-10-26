<?php

require_once(CITYPHP . 'sha1Token.php');
require_once(VANILLA . 'database/TokenModel.php');

class ResetPasswordModel extends TokenModel {
    public function __construct(DatabaseHandle $databaseHandle) {
        parent::__construct($databaseHandle, TABLE_RESET_PASSWORD_TOKENS, RESET_PASSWORD_DAYS);
    }

    public function sendEmail($userID, $username, $email) {
        $token = sha1Token();
        $subject = 'Reset Your Password';
        $additionalHeaders = sprintf("From: %s\r\n", EMAIL_FROM);
        $message = sprintf("%s,\n\nUse this link to reset your password:\n\n"
            . '%s%s%d/%s', $username,
            DOMAIN, RESET_PASSWORD, $userID, $token);

        $this->createToken($userID, $token);
        mail($email, $subject, $message, $additionalHeaders);
    }

    public function getToken($userID, $token) {
        return parent::getToken($userID, $token);
    }

    public function deleteToken($tokenID) {
        parent::deleteToken($tokenID);
    }
}

?>
