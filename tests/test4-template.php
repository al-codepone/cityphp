<?php

require_once 'const.php';
require_once CITYPHP . 'html/blist.php';

$title = 'Page Title';
$content = blist(array('one', 'two', 'three'));

include PURPLE . 'html/template.php';

?>
