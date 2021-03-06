<?php

function radioButtons(
    array $radioButtons,
    $name,
    $checkedValue = null,
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

    foreach($radioButtons as $value => $label) {
        print input(
            array('id' => $name . $i++,
                'name' => $name,
                'type' => 'radio',
                'value' => $value,
                !is_null($checkedValue) && $value == $checkedValue ? 'checked' : ''),
            $label);
    }

    print $isContainer ? '</div>' : '';
    return ob_get_clean();
}

?>
