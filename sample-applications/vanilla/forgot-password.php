<?php

require_once(STD_LIB . 'html/autofocus.php');
require_once(VANILLA . 'forms/ForgotPasswordValidator.php');
require_once(VANILLA . 'html/forgotPassword.php');

$validator = new ForgotPasswordValidator();

if(list($formData, $errors) = $validator->validate()) {
    if($errors) {
        $content = forgotPassword($formData, current($errors));
    }
    else {
        $resetPasswordModel = MyModelFactory::getModel('ResetPasswordModel');
        $resetPasswordModel->createToken($formData['email']);
        $content = 'We emailed you directions for resetting your password.';
    }
}
else {
    $autofocus = autofocus('email');
    $content = forgotPassword($validator->values());
}

?>
