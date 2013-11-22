<?php

require_once 'const.php';
require_once CITYPHP . 'html/attributes.php';

echo implode("\n\n", array(
    sprintf('<tag%s/>', attributes(array(
        'name1' => 'value1',
        'name2' => '"value2"',
        'value3'))),

    sprintf('<tag%s></tag>', attributes(array(
        'name1' => 'value1',
        'name2' => ''))),

    sprintf('<tag%s/>', attributes(array(
        '<value1>',
        false ? 'value2' : '',
        true ? 'value3' : '')))));

?>
