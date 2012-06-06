<?php

require_once(CITY_PHP . 'forms/FormHandler.php');

class DeleteAccountFormHandler extends FormHandler {
    public function __construct() {
        parent::__construct(array('xpassword' => ''));
    }
}

?>
