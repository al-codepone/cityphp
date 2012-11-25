<?php

function checkbox($label, $name, $id, $value, $isChecked) {
    return sprintf("<div><input type='checkbox' name='$name' id='$id' value='%s'%s/>"
        . "<label for='$id'>$label</label></div>",
        htmlspecialchars($value),
        $isChecked ? ' checked' : '');
}

?>
