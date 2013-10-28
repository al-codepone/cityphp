<?php

require_once 'constants.php';
require_once CITYPHP . 'html/blist.php';

$title = 'Page Title';
$content = blist(array('one', 'two', 'three'));

include PURPLE . 'html/template.php';

?>
