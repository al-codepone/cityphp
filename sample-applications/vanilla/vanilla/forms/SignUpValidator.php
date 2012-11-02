<?php

require_once(CITYPHP . 'forms/FormValidator.php');
require_once(VANILLA . 'forms/isPassword.php');
require_once(VANILLA . 'forms/validateUsername.php');

class SignUpValidator extends FormValidator {
    public function __construct() {
        parent::__construct(array(
            'username' => '',
            'email' => '',
            'password' => ''));
    }

    protected function validate_username($value) {
        return validateUsername($value);
    }

    protected function validate_email($value) {
        if($value != '' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return 'Invalid email';
        }
    }

    protected function validate_password($value) {
        if(!isPassword($value)) {
            return 'Invalid password';
        }
    }
}

?>