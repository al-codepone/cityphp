<?php

require_once(CITYPHP . 'database/DatabaseAdapter.php');
require_once(CITYPHP . 'getHash.php');

class UserModel extends DatabaseAdapter {
    public function install() {
        $this->query('CREATE TABLE ' . TABLE_USERS . ' (
            user_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
			username VARCHAR(32),
            email VARCHAR(255),
            password VARCHAR(128),
            PRIMARY KEY (user_id))
            ENGINE = MYISAM');
    }

    public function createUser($data) {
        if($this->getUserWithUsername($data['username'])) {
            return sprintf('Username "%s" already in use', $data['username']);
        }
        else if($this->getUserWithEmail($data['email'])) {
            return sprintf('Email "%s" already in use', $data['email']);
        }
        else {
            $this->query(sprintf('INSERT INTO %s
                (user_id, username, email, password) VALUES(NULL, "%s", "", "%s")',
                TABLE_USERS,
                $this->esc($data['username']),
                $this->esc(getHash($data['password']))));

            $userID = $this->getConn()->insert_id;

            if($data['email']) {
                $verifyEmailModel = MyModelFactory::getModel('VerifyEmailModel');
                $verifyEmailModel->createToken($userID, $data['username'], $data['email']);
            }
        }
    }

    public function getUserWithUID($userID) {
        return $this->getUser(sprintf('user_id = %d', $userID));
    }

    public function getUserWithUsername($username) {
        return $this->getUser(sprintf('username = "%s"',
            $this->esc($username)));
    }

    public function getUserWithEmail($email) {
        return $email
            ? $this->getUser(sprintf('email = "%s"', $this->esc($email)))
            : null;
    }

    public function updateUser($userID, $data) {
        $setPassword = $data['password']
            ? sprintf(', password = "%s"', $this->esc(getHash($data['password'])))
            : '';

        $this->query(sprintf('UPDATE %s SET username = "%s"%s WHERE user_id = %d',
            TABLE_USERS,
            $this->esc($data['username']),
            $setPassword,
            $userID));
    }

    public function updateEmail($userID, $email) {
        $this->query(sprintf('UPDATE %s SET email = "%s" WHERE user_id = %d',
            TABLE_USERS,
            $this->esc($email),
            $userID));
    }

    public function updatePassword($userID, $password) {
       $this->query(sprintf('UPDATE %s SET password = "%s" WHERE user_id = %d',
            TABLE_USERS,
            $this->esc(getHash($password)),
            $userID));
    }

    public function deleteUser($userID) {
        $this->query(sprintf('DELETE FROM %s WHERE user_id = %d',
            TABLE_USERS,
            $userID));
    }

    protected function getUser($condition) {
        $queryData = $this->fetchQuery(sprintf('SELECT user_id, username, email, password
            FROM %s WHERE %s',
            TABLE_USERS,
            $condition));

        return $queryData[0];
    }
}

?>
