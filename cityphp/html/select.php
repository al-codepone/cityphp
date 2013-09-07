<?php

require_once CITYPHP . 'html/attributes.php';

function select(
    $options,
    $selectAttributes = array(),
    $label = '',
    $selectedValues = array(),
    $isContainer = true,
    $labelAttributes = array(),
    $containerAttributes = array())
{
    if($id = $selectAttributes['id']) {
        $selectAttributes['name'] = $id;
        $labelAttributes['id'] = "l_$id";
        $labelAttributes['for'] = $id;
        $containerAttributes['id'] = "c_$id";
    }

    $isMultiple = in_array('multiple', $selectAttributes);

    if($isMultiple) {
        $selectAttributes['name'] = $selectAttributes['name'] . '[]';
    }

    ob_start();

    print $isContainer
        ? sprintf('<div%s>', attributes($containerAttributes))
        : '';

    print ($label != '')
        ? sprintf('<label%s>%s</label>',
            attributes($labelAttributes),
            htmlspecialchars($label))

        : '';

    printf('<select%s>', attributes($selectAttributes));

    foreach($options as $value => $content) {
        $isSelected = ($isMultiple && in_array($value, $selectedValues))
            || $value == $selectedValues;

        printf('<option%s>%s</option>',
            attributes(array('value' => $value,
                $isSelected ? 'selected' : '')),
            htmlspecialchars($content));
    }

    print '</select>';
    print $isContainer ? '</div>' : '';
    return ob_get_clean();
}

?>
