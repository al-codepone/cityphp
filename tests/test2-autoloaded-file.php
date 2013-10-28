<?php

require_once 'constants.php';

//manually load the autoloader
require_once CITYPHP . '__autoload.php';

//autoload and import the Monster class
use purple\Monster;

$monster = new Monster();
$monster->talk();

?>
