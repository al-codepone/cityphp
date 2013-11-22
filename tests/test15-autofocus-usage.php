<?php

require_once 'const.php';
require_once CITYPHP . 'html/autofocus.php';
require_once PURPLE . 'html/dummyForm.php';

$content = dummyForm();
$autofocus = autofocus('input1');

include PURPLE . 'html/template3.php';

?>
