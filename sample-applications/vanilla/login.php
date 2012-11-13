<?php

require_once(STD_LIB . 'html/autofocus.php');
require_once(VANILLA . 'forms/LoginValidator.php');
require_once(VANILLA . 'html/login.php');

$validator = new LoginValidator();

if($user) {
    $content = 'You are already logged in.';
}
else if(list($formData, $errors) = $validator->validate()) {
    if($error = $loginModel->login($formData)) {
        $content = login($formData, $error);
    }
    else {
        header('Location:' . ROOT);
        exit();
    }
}
else {
    $autofocus = autofocus('username');
    $content = login($validator->values());
}

?>
