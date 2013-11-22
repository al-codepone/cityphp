<?php

require_once 'const.php';
require_once CITYPHP . 'html/select.php';

echo implode("\n\n", array(
    select(array('red', 'blue', 'gold')),

    select(
        array(1, 2, 3, 4),
        array('id' => 'numbers')),

    select(
        array(1 => 'dog', 'cat', 'bird'),
        array('id' => 'animals'),
        'Animals'),

    select(
        array(1 => 'dog', 'cat', 'bird'),
        array('id' => 'pets'),
        'Pets',
        2),

    select(
        array('a', 'b', 'c', 'd', 'e', 'f', 'g'),
        array('id' => 'notes', 'size' => 7, 'multiple'),
        'Notes',
        array(0, 1, 6),
        false),

    select(
        array(1, 3, 5),
        array('name' => 'odds'),
        'Odds',
        -1,
        true,
        array('class' => 'big-label')),

    select(
        array('run', 'jump', 'swim'),
        array('id' => 'verbs', 'multiple'),
        'Verbs',
        array(),
        true,
        array('style' => 'color:white;'),
        array('style' => 'background:brown'))));

?>
