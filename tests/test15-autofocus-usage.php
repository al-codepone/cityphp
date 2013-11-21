<?php

require_once 'constants.php';
require_once CITYPHP . 'html/autofocus.php';
require_once PURPLE . 'html/dummyForm.php';

$content = dummyForm();
$autofocus = autofocus('input1');

include PURPLE . 'html/template3.php';

?>
