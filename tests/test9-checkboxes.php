<?php

require_once 'const.php';
require_once CITYPHP . 'html/checkboxes.php';

echo implode("\n\n", array(
    checkboxes(
        array('apple', 'pear', 'kiwi'),
        'fruit'),

    checkboxes(
        array(1 => 'html', 'css', 'php', 'c++'),
        'skills',
        array(1, 4),
        'Skills'),

    checkboxes(
        array('circle', 'square', 'triangle'),
        'shapes',
        array(),
        'Shapes',
        true,
        array('style' => 'color:green;'))));

?>
