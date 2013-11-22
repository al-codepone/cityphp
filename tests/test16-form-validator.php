<?php

require_once 'constants.php';
require_once CITYPHP . '__autoload.php';
require_once CITYPHP . 'html/autofocus.php';
require_once PURPLE . 'html/myForm.php';
 
$validator = new purple\forms\MyValidator();
 
if(list($inputValues, $errors) = $validator->validate()) {
    $content = $errors
        ? myForm($inputValues, $errors)
        : '<pre>' . print_r($inputValues, true) . '</pre>';
}
else {
    $content = myForm($validator->values());
    $autofocus = autofocus('input1');
}

include PURPLE . 'html/template3.php';

?>
