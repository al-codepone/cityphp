<?php

require 'vendor/autoload.php';

echo implode(', ', array(
    clamp(5, 1, 10),
    clamp(0, 1, 10),
    clamp(11, 1, 10),
    clamp(11, 1, 10.4),
    clamp('d', 'c', 'f'),
    clamp('a', 'c', 'f'),
    clamp('i', 'c', 'f')));

?>
