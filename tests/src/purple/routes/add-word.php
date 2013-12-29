<?php

$validator = new purple\forms\MyValidator();
 
if(list($inputValues, $errors) = $validator->validate()) {
    if($errors) {
        $content = myForm($inputValues, $errors);
    }
    else {
        $words = $inputValues;
        $words['food'] = implode('|', $words['food']);
        $wordModel->create($words);
        $content = 'Success. These words were added:'
            . implode(
                array_map(
                    function($word) {
                        return '<br/>' . htmlspecialchars($word);
                    },
                    $words));
    }
}
else {
    $content = myForm($validator->values());
    $autofocus = autofocus('input1');
}

$title = 'Add Word';

?>
