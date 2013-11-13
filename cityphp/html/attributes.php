<?php

function attributes(array $attributes) {
    ob_start();

    foreach($attributes as $i => $v) {
        if($v !== '') {
            $v = htmlspecialchars($v);

            print is_int($i)
                ? " $v"
                : " $i=\"$v\"";
        }
    }

    return ob_get_clean();
}

?>
