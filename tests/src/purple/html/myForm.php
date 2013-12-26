<?php

function myForm(array $inputValues, $errors = array()) {
    return
        '<form method="post">'

        . blist($errors, array('style' => 'color:red;'))

        . input(array(
            'id' => 'input1',
            'value' => $inputValues['input1']),
            'Input 1')

        . input(array(
            'id' => 'input2',
            'value' => $inputValues['input2']),
            'Input 2')

        . input(array(
            'id' => 'input3',
            'value' => $inputValues['input3']),
            'Input 3')

        . checkboxes(
            array('pear', 'cookie', 'chips', 'shrimp', 'a drink', 'waffle'),
            'food',
            $inputValues['food'],
            'Food')

        . input(array(
            'type' => 'submit',
            'value' => 'Submit'))

        . '</form>';
}

?>
