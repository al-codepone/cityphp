<?php

require_once(CITYPHP . 'sha1Token.php');
require_once(VANILLA . 'database/TokenModel.php');

class VerifyEmailModel extends TokenModel {
    public function __construct(DatabaseHandle $databaseHandle) {
        parent::__construct($databaseHandle, TABLE_VERIFY_EMAIL_TOKENS);
    }

    public function sendEmail($userID, $username, $email) {
        $token = sha1Token();
        $subject = 'Verify Your Email';
        $additionalHeaders = sprintf("From: %s\r\n", EMAIL_FROM);
        $message = sprintf("%s,\n\nClick the link to verify your email:\n\n"
            . '%s%s%d/%s', $username,
            SITE, VERIFY_EMAIL, $userID, $token);

        $this->createToken($userID, $token, $email);
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
