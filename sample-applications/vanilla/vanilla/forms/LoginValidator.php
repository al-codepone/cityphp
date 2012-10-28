<?php

require_once(CITYPHP . 'forms/FormValidator.php');

class LoginValidator extends FormValidator {
    public function __construct() {
        parent::__construct(
            array(
                'username' => '',
                'password' => '',
                'remember_me' => false),
            array(
                'remember_me'));
    }
}

?>
