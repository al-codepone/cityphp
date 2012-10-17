<?php

require_once(CITYPHP . 'forms/FormValidator.php');

class SettingsValidator extends FormValidator {
    public function __construct() {
        parent::__construct(array(
            'delete_flag' => false,
            'username' => '',
            'email' => '',
            'new_password' => '',
            'confirm_password' => '',
            'current_password' => ''));
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

    protected function validate_new_password($value) {
        if($value != '' && !preg_match(REGEX_PASSWORD, $value)) {
            return 'Invalid new password';
        }
    }

    protected function validate_confirm_password($value) {
        if($value != '' && !preg_match(REGEX_PASSWORD, $value)) {
            return 'Invalid confirm password';
        }
    }
}

?>
