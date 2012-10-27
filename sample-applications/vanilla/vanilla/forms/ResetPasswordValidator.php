<?php

require_once(CITYPHP . 'forms/FormValidator.php');
require_once(VANILLA . 'forms/isPassword.php');

class ResetPasswordValidator extends FormValidator {
    public function __construct() {
        parent::__construct(array(
            'password' => '',
            'confirm_password' => ''));
    }

    protected function validate_password($value) {
        if(!isPassword($value)) {
            return 'Invalid new password';
        }
    }

    protected function validate_confirm_password($value) {
        if(!isPassword($value)) {
            return 'Invalid confirm password';
        }
    }
}

?>
