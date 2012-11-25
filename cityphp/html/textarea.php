<?php

function textarea($label, $id, $value) {
    return sprintf("<div><label for='$id'>$label</label>"
        . "<textarea name='$id' id='$id'>%s</textarea></div>",
        htmlspecialchars($value));
}

?>
