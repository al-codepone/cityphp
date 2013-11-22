<?php

require_once 'const.php';
require_once CITYPHP . 'html/blist.php';

echo implode("\n\n", array(
    blist('jan'),

    blist(array('feb', 'mar', 'apr')),

    blist(array(
        'may' => array('style' => 'font-size:3em;'),
        'jun',
        'jul' => array('id' => 'last-item'))),

    blist(array('fall', 'winter', 'spring'),
        array('class' => 'seasons')),

    blist(array('castle', 'ship', 'forest'),
        array('type' => 'A'),
        true)));

?>
