<?php

require_once(CITYPHP . 'forms/FormHandler.php');

class LoginFormHandler extends FormHandler {
    public function __construct() {
        parent::__construct(array(
            'username' => '',
            'password' => ''));
    }
}

?>
