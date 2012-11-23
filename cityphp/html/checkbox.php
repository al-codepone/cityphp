<?php

function checkbox($label, $name, $id, $value, $isChecked) {
    return sprintf('<div><input type="checkbox" name="%2$s" id="%3$s" value="%4$s"%5$s/>'
        . '<label for="%3$s">%1$s</label></div>',
        $label, $name, $id, $value, $isChecked ? ' checked' : '');
}

?>
