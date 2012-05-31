<?php

require_once(CITY_PHP . 'forms/FormHandler.php');

class SettingsFormHandler extends FormHandler {
    public function __construct() {
        $elementValues = array('xusername' => '');
        parent::__construct($elementValues);
    }

    protected function validate_xusername($value) {
        if(preg_match(REGEX_USERNAME, $value)) {
            return '';
        }

        return 'invalid username';
    }
}

?>
