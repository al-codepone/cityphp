<?php

require_once(CITY_PHP . 'forms/FormHandler.php');

class NewMessageFormHandler extends FormHandler {
    public function __construct() {
        $elementValues = array('xmessage' => '');
        parent::__construct($elementValues);
    }

    protected function validate_xmessage($value) {
        if(trim($value) != '') {
            return '';
        }

        return 'Invalid message';
    }
}

?>
