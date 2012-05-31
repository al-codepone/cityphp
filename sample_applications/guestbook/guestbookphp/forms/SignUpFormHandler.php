<?php

require_once(CITY_PHP . 'forms/FormHandler.php');

class SignUpFormHandler extends FormHandler {
    public function __construct() {
        $elementValues = array('xusername' => '',
                               'xpassword' => '');

        parent::__construct($elementValues);
    }

    protected function validate_xusername($value) {
        if(preg_match(REGEX_USERNAME, $value)) {
            return '';
        }

        return 'invalid username';
    }

    protected function validate_xpassword($value) {
        if(preg_match(REGEX_PASSWORD, $value)) {
            return '';
        }

        return 'invalid password';
    }
}

?>
