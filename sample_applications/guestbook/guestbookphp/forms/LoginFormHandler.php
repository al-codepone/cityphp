<?php

require_once(CITY_PHP . 'forms/FormHandler.php');

class LoginFormHandler extends FormHandler {
    public function __construct() {
        $elementValues = array('xusername' => '',
                               'xpassword' => '');

        parent::__construct($elementValues);
    }
}

?>
