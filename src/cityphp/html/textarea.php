<?php

function textarea(
    array $textareaAttributes = array(),
    $content = '',
    $label = '',
    $isContainer = true,
    array $labelAttributes = array(),
    array $containerAttributes = array())
{
    if($id = $textareaAttributes['id']) {
        $textareaAttributes['name'] = $id;
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

        . sprintf('<textarea%s>%s</textarea>',
            attributes($textareaAttributes),
            htmlspecialchars($content))

        . ($isContainer ? '</div>' : '');
}

?>
