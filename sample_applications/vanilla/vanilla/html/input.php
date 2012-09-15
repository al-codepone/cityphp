<?php

function input($label, $id, $value, $type = 'text') {
    return sprintf('<div><label for="%2$s">%1$s</label>'
        . '<input type="%4$s" name="%2$s" id="%2$s" value="%3$s"/></div>',
        $label, $id, htmlspecialchars($value), $type);
}

?>
