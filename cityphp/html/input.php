<?php

function input($label, $id, $value, $type = 'text') {
    return sprintf("<div><label for='$id'>$label</label>"
        . "<input type='$type' name='$id' id='$id' value='%s'/></div>",
        htmlspecialchars($value));
}

?>
