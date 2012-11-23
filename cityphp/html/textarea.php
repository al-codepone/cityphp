<?php

function textarea($label, $id, $value) {
    return sprintf('<div><label for="%2$s">%1$s</label>'
        . '<textarea name="%2$s" id="%2$s">%3$s</textarea></div>',
        $label, $id, htmlspecialchars($value));
}

?>
