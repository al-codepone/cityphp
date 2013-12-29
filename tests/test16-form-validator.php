<?php

require 'vendor/autoload.php';
 
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

include 'src/purple/html/template3.php';

?>
