<?php

require_once 'const.php';

//enable autoload
require_once CITYPHP . '__autoload.php';

//import
use purple\Monster;

//autoload
$monster = new Monster();
$monster->talk();

?>
