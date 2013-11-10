<?php

require_once 'constants.php';
require_once CITYPHP . 'html/textarea.php';

echo implode("\n\n", array(
    textarea(),

    textarea(array('id' => 'story')),

    textarea(array('id' => 'answer'), 'blah blah blah'),
    
    textarea(
        array('name' => 'thoughts'),
        '',
        'Thoughts'),

    textarea(
        array('id' => 'entry'),
        '',
        'Entry',
        false,
        array('style' => 'color:brown;')),
 
    textarea(
        array('name' => 'bio'),
        'I was born in east LA.',
        'Bio',
        true,
        array('style' => 'color:brown;'),
        array(
            'style' => 'background:#aaaaff;',
            'class' => 'glow'))));

?>
