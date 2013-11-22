<?php

require_once 'const.php';
require_once CITYPHP . 'html/radioButtons.php';

echo implode("\n\n", array(
    radioButtons(
        array('all', 'active', 'none'),
        'mode'),

    radioButtons(
        array('a' => 'buzz', 'b' => 'dreads', 'c' => 'rat tail'),
        'hair',
        'b',
        'Hair Style'),

    radioButtons(
        array(1 => 'breakfast', 'lunch', 'dinner'),
        'meal',
        3,
        'Favorite Meal',
        true,
        array('style' => 'color:gray;'))));

?>
