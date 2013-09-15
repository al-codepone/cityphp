<?php

require_once CITYPHP . 'html/attributes.php';

function ulist($items, $ulAttributes = array()) {
    $items = is_array($items) ? $items : array($items);

    if($items) {
        ob_start();
        printf('<ul%s>', attributes($ulAttributes));

        foreach($items as $item) {
            print "<li>$item</li>";
        }

        print '</ul>';
        return ob_get_clean();
    }
}

?>
