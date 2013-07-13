<?php

function input($label, $id, $value = '',
    $attributes = array(), $isContainer = true)
{
    ob_start();
    print $isContainer ? "<div id=\"c_$id\">" : '';
    print ($label == '')
        ? ''
        : sprintf("<label id=\"l_$id\" for=\"$id\">%s</label>",
            htmlspecialchars($label));

    print '<input ';
    print ($value == '')
        ? ''
        : sprintf('value="%s" ', htmlspecialchars($value));

    foreach($attributes as $i => $v) {
        print is_int($i)
            ? "$v "
            : "$i=\"$v\" ";
    }

    print "name=\"$id\" id=\"$id\"/>";
    print $isContainer ? '</div>' : '';
    return ob_get_clean();
}

?>
