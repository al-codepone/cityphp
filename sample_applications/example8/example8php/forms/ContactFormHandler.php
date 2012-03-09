<?php

require_once(CITY_PHP . 'forms/FormHandler.php');

class ContactFormHandler extends FormHandler {
    public function __construct() {
        $elementValues = array('xname' => '',
            'xemail' => '',
            'xmessage' => '');
        parent::__construct($elementValues);
    }

    protected function validate_xname($value) {
        if(trim($value) != '') {
            return '';
        }

        return 'Invalid name';
    }

    protected function validate_xemail($value) {
        if(strstr($value, '@')) {
            return '';
        }

        return 'Invalid email';
    }

    protected function validate_xmessage($value) {
        if(trim($value) != '') {
            return '';
        }

        return 'Invalid message';
    }
}

?>
