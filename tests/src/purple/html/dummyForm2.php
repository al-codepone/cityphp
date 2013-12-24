<?php

require_once CITYPHP . 'html/checkboxes.php';
require_once CITYPHP . 'html/input.php';

function dummyForm2() {
    return
        '<form method="post">'

        . input(array(
            'id' => 'input1',
            'type' => 'checkbox'),
            'Input 1')

        . input(array(
            'id' => 'input2',
            'type' => 'checkbox'),
            'Input 2')

        . checkboxes(
            array('a', 'b', 'c'),
            'input3',
            array(),
            'Input 3')

        . checkboxes(
            array('a', 'b', 'c'),
            'input4',
            array(),
            'Input 4')

        . input(array(
            'type' => 'submit',
            'value' => 'Submit'))

        . '</form>';
}

?>
