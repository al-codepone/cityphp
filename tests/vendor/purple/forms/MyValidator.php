<?php

namespace purple\forms;

use cityphp\forms\FormValidator;

class MyValidator extends FormValidator {
    public function __construct() {
        parent::__construct(array(
            'input1' => '',
            'input2' => '',
            'input3' => '',
            'food' => array()),
            array('food'));
    }

    protected function validate_input1($value) {
        if(!preg_match('/^[a-z0-9]{1,10}$/i', $value)) {
            return 'Input 1 must be 1-10 characters; letters and numbers only';
        }
    }

    protected function validate_input2($value) {
        if(strlen($value) < 6) {
            return 'Input 2 must be 6 or more characters';
        }
    }

    protected function validate_food($value) {
        if(count($value) != 4) {
            return 'Choose 4 foods';
        }
    }

    protected function validateOther($values) {
        if($values['input2'] != $values['input3']) {
            return "Inputs 2 and 3 must be the same";
        }
    }
}

?>
