<?php

require 'vendor/autoload.php';
 
$utcNow = datetimeNow();
$laNow = datetimeTo($utcNow, 'America/Los_Angeles', 'M j, Y g:ia');
echo "utcNow = $utcNow, laNow = $laNow";

?>
