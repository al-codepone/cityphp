<?php

function input(
    array $inputAttributes = array(),
    $label = '',
    $isContainer = true,
    array $labelAttributes = array(),
    array $containerAttributes = array())
{
    if($id = $inputAttributes['id']) {
        $inputAttributes['name'] = $inputAttributes['name']
            ? $inputAttributes['name']
            : $id;

        $labelAttributes['id'] = "l_$id";
        $labelAttributes['for'] = $id;
        $containerAttributes['id'] = "c_$id";
    }

    return
        ($isContainer
            ? sprintf('<div%s>', attributes($containerAttributes))
            : '')

        . (($label != '')
            ? sprintf('<label%s>%s</label>',
                attributes($labelAttributes),
                htmlspecialchars($label))

            : '')

        . sprintf('<input%s/>', attributes($inputAttributes))
        . ($isContainer ? '</div>' : '');
}

?>
