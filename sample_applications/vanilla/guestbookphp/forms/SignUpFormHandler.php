<?php

require_once(CITYPHP . 'forms/FormHandler.php');

class SignUpFormHandler extends FormHandler {
    public function __construct() {
        parent::__construct(array(
            'username' => '',
            'password' => ''));
    }

    protected function validate_username($value) {
        if(!preg_match(REGEX_USERNAME, $value)) {
            return 'Invalid username';
        }
    }

    protected function validate_password($value) {
        if(!preg_match(REGEX_PASSWORD, $value)) {
            return 'Invalid password';
        }
    }
}

?>
