<?php

require_once(CITY_PHP . 'forms/FormHandler.php');

class ChangePasswordFormHandler extends FormHandler {
    public function __construct() {
        $elementValues = array('xcurrpass' => '',
                               'xnewpass' => '',
                               'xrepass' => '');

        parent::__construct($elementValues);
    }

    protected function validate_xcurrpass($value) {
        if(preg_match(REGEX_PASSWORD, $value)) {
            return '';
        }

        return 'Current password invalid';
    }

    protected function validate_xnewpass($value) {
        if(preg_match(REGEX_PASSWORD, $value)) {
            return '';
        }

        return 'New password invalid';
    }

    protected function validate_xrepass($value) {
        if(preg_match(REGEX_PASSWORD, $value)) {
            return '';
        }

        return 'Retyped password invalid';
    }
}

?>
