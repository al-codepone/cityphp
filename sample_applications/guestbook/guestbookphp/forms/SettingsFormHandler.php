<?php

require_once(CITY_PHP . 'forms/FormHandler.php');

class SettingsFormHandler extends FormHandler {
    public function __construct() {
        $elementValues = array('xdeleteflag' => false,
            'xusername' => '',
            'xnewpassword' => '',
            'xconfirmpassword' => '',
            'xcurrentpassword' => '');

        parent::__construct($elementValues);
    }

    protected function validate_xusername($value) {
        if(preg_match(REGEX_USERNAME, $value)) {
            return '';
        }

        return 'Invalid username';
    }

    protected function validate_xnewpassword($value) {
        if($value == '' || preg_match(REGEX_PASSWORD, $value)) {
            return '';
        }

        return 'Invalid new password';
    }

    protected function validate_xconfirmpassword($value) {
        if($value == '' || preg_match(REGEX_PASSWORD, $value)) {
            return '';
        }

        return 'Invalid confirm password';
    }
}

?>
