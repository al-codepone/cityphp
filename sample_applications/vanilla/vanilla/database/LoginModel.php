<?php

require_once(VANILLA . 'database/TokenModel.php');

class LoginModel extends TokenModel {
    public function __construct(DatabaseHandle $databaseHandle) {
        parent::__construct($databaseHandle, TABLE_PERSISTENT_LOGIN_TOKENS);
    }

    public function createPersistentLogin($userID) {
        $token = sha1(uniqid(mt_rand(), true));
        $this->createToken($userID, $token);
        setcookie(COOKIE_PERSISTENT_LOGIN, "$userID.$token",
            time() + 60*60*24*PERSISTENT_LOGIN_DAYS);
    }

    public function deletePersistentLogin() {
        if($data = $this->getPersistentLogin()) {
            $this->deleteToken($data['token_id']);
        }

        setcookie(COOKIE_PERSISTENT_LOGIN, '', time() - 3600);
    }

    public function getActiveUser() {
        if(isset($_SESSION[SESSION_USER_ID])) {
            return $this->getSessionUser();
        }
        else if($data = $this->getPersistentLogin()) {
            $this->deleteToken($data['token_id']);
            $this->createPersistentLogin($data['user_id']);

            $_SESSION[SESSION_USER_ID] = $data['user_id'];
            $_SESSION[SESSION_USERNAME] = $data['username'];
            return $this->getSessionUser();
        }
    }

    private function getPersistentLogin() {
        if($_COOKIE[COOKIE_PERSISTENT_LOGIN]) {
            list($userID, $token) = explode('.', $_COOKIE[COOKIE_PERSISTENT_LOGIN]);
            return $this->getToken($userID, $token);
        }
    }

    private function getSessionUser() {
        return array('user_id' => $_SESSION[SESSION_USER_ID],
            'username' => $_SESSION[SESSION_USERNAME]);
    }
}

?>
