<?php

function checkbox($label, $id, $name, $isChecked) {
    return sprintf('<div><input type="checkbox" id="%2$s" name="%3$s"%4$s/>'
        . '<label for="%2$s">%1$s</label></div>',
        $label, $id, $name, $isChecked ? ' checked' : '');
}

?>
