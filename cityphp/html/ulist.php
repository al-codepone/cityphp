<?php

require_once CITYPHP . 'html/attributes.php';

function ulist($items, $ulAttributes = array()) {
    $items = is_array($items) ? $items : array($items);

    if($items) {
        ob_start();
        printf('<ul%s>', attributes($ulAttributes));

        foreach($items as $i => $v) {
            print is_array($v)
                ? sprintf("<li%s>$i</li>", attributes($v))
                : "<li>$v</li>";
        }

        print '</ul>';
        return ob_get_clean();
    }
}

?>
