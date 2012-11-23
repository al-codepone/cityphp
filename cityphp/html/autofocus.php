<?php

function autofocus($id) {
    return sprintf('<script>document.getElementById'
        . '("%s").focus();</script>', $id);
}

?>
