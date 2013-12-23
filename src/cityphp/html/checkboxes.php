<?php

function checkboxes(
    array $checkboxes,
    $name,
    array $checkedValues = array(),
    $title = '',
    $isContainer = true,
    array $containerAttributes = array())
{
    $containerAttributes['id'] = "c_$name";
    $i = 0;
    ob_start();

    print $isContainer
        ? sprintf('<div%s>', attributes($containerAttributes))
        : '';

    print ($title != '')
        ? sprintf("<span%s>$title</span>",
            attributes(array('id' => "t_$name")))

        : '';

    foreach($checkboxes as $value => $label) {
        print input(
            array('id' => $name . $i++,
                'name' => $name . '[]',
                'type' => 'checkbox',
                'value' => $value,
                in_array($value, $checkedValues) ? 'checked' : ''),
            $label);
    }

    print $isContainer ? '</div>' : '';
    return ob_get_clean();
}

?>
