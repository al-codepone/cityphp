<?php

function blist($items, array $listAttributes = array(), $isOrdered = false) {
    $items = is_array($items) ? $items : array($items);
    $listType = $isOrdered ? 'ol' : 'ul';

    if($items) {
        ob_start();
        printf("<$listType%s>", attributes($listAttributes));

        foreach($items as $i => $v) {
            print is_array($v)
                ? sprintf("<li%s>$i</li>", attributes($v))
                : "<li>$v</li>";
        }

        print "</$listType>";
        return ob_get_clean();
    }
}

?>
