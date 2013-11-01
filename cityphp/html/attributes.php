<?php

function attributes($attributes) {
    ob_start();

    foreach($attributes as $i => $v) {
        if($v !== '') {
            print is_int($i)
                ? " $v"
                : sprintf(" $i=\"%s\"", htmlspecialchars($v));
        }
    }

    return ob_get_clean();
}

?>
