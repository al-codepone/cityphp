<?php

require_once(CITYPHP . 'forms/FormValidator.php');

class SignUpValidator extends FormValidator {
    public function __construct() {
        parent::__construct(array(
            'username' => '',
            'email' => '',
            'password' => ''));
    }

    protected function validate_username($value) {
        if(!preg_match(REGEX_USERNAME, $value)) {
            return 'Invalid username';
        }
    }

    protected function validate_email($value) {
        if($value != '' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return 'Invalid email';
        }
    }

    protected function validate_password($value) {
        if(!preg_match(REGEX_PASSWORD, $value)) {
            return 'Invalid password';
        }
    }
}

?>
