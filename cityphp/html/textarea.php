<?php

require_once CITYPHP . 'html/attributes.php';

function textarea(
    $textareaAttributes = array(),
    $content = '',
    $label = '',
    $isContainer = true,
    $labelAttributes = array(),
    $containerAttributes = array())
{
    if($id = $textareaAttributes['id']) {
        $textareaAttributes['name'] = $id;
        $labelAttributes['id'] = "l_$id";
        $labelAttributes['for'] = $id;
        $containerAttributes['id'] = "c_$id";
    }

    ob_start();

    echo
        $isContainer
            ? sprintf('<div%s>', attributes($containerAttributes))
            : '',

        ($label != '')
            ? sprintf("<label%s>%s</label>",
                attributes($labelAttributes),
                htmlspecialchars($label))

            : '',

        sprintf('<textarea%s>%s</textarea>',
            attributes($textareaAttributes),
            htmlspecialchars($content)),

        $isContainer ? '</div>' : '';

    return ob_get_clean();
}

?>
