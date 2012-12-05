<?php

require_once(CITYPHP . 'forms/FormValidator.php');
require_once(VANILLA . 'forms/isPassword.php');
require_once(VANILLA . 'forms/validateUsername.php');

class SettingsValidator extends FormValidator {
    public function __construct() {
        parent::__construct(array(
            'delete_flag' => false,
            'username' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'current_password' => ''));
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
        if($value != '' && !isPassword($value)) {
            return 'New password must be at least 8 characters';
        }
    }

    protected function validate_confirm_password($value) {
        if($value != '' && !isPassword($value)) {
            return 'Confirm new password must be at least 8 characters';
        }
    }
}

?>
