<?php

function textarea($label, $id, $value = '',
    $attributes = array(), $isContainer = true)
{
    ob_start();
    print $isContainer ? "<div id=\"c_$id\">" : '';
    print ($label == '')
        ? ''
        : sprintf("<label id=\"l_$id\" for=\"$id\">%s</label>",
            htmlspecialchars($label));

    print '<textarea ';

    foreach($attributes as $i => $v) {
        print is_int($i)
            ? "$v "
            : "$i=\"$v\" ";
    }

    printf("name=\"$id\" id=\"$id\">%s</textarea>",
        htmlspecialchars($value));

    print $isContainer ? '</div>' : '';
    return ob_get_clean();
}

?>
