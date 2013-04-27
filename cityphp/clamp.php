<?php

function clamp($value, $min, $max) {
    return min(max($value, $min), $max);
}

?>
