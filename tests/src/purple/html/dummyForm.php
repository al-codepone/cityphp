<?php

require_once CITYPHP . 'html/input.php';

function dummyForm() {
    return
        '<form method="post">'

        . input(array(
            'id' => 'input1'),
            'Input 1')

        . input(array(
            'type' => 'submit',
            'value' => 'Submit'))

        . '</form>';
}

?>
