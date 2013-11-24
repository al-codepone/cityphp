<?php

namespace vanilla\database;

require_once CITYPHP . 'sha1Token.php';

use cityphp\db\DatabaseHandle;
use vanilla\database\ModelFactory;

class LoginModel extends TokenModel {
    public function __construct(DatabaseHandle $databaseHandle) {
        parent::__construct($databaseHandle, TABLE_PERSISTENT_LOGIN_TOKENS, TTL_PERSISTENT_LOGIN);
    }

    public function login($formData) {
        $userModel = ModelFactory::get('vanilla\database\UserModel');
        $userData = $userModel->getUserWithUsername($formData['username']);

        if(!$userData || $userData['password'] != bcryptHash($formData['password'], $userData['password'])) {
            return 'Incorrect username and password';
        }

        if($formData['remember_me']) {
            $this->createPersistentLogin($userData['user_id']);
        }

        $_SESSION[SESSION_USER_ID] = $userData['user_id'];
        $_SESSION[SESSION_USERNAME] = $userData['username'];
    }

    public function logOut() {
        if($data = $this->getPersistentLogin()) {
            $this->deleteToken($data['token_id']);
        }

        setcookie(COOKIE_PERSISTENT_LOGIN, '', time() - 3600);
        unset($_SESSION[SESSION_USER_ID]);
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

    private function createPersistentLogin($userID) {
        $token = sha1Token();
        $this->createToken($userID, $token);
        setcookie(COOKIE_PERSISTENT_LOGIN, "$userID.$token",
            time() + 60*60*24*TTL_PERSISTENT_LOGIN);
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
