<?php

require_once 'const.php';
require_once CITYPHP . 'time/datetimeNow.php';
require_once CITYPHP . 'time/datetimeTo.php';
 
$utcNow = datetimeNow();
$laNow = datetimeTo($utcNow, 'America/Los_Angeles', 'M j, Y g:ia');
echo "utcNow = $utcNow, laNow = $laNow";

?>
