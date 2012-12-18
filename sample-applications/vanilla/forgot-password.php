<?php

require_once(CITYPHP . 'html/autofocus.php');
require_once(VANILLA . 'forms/ForgotPasswordValidator.php');
require_once(VANILLA . 'html/forgotPassword.php');

$validator = new ForgotPasswordValidator();

if(list($formData, $errors) = $validator->validate()) {
    if($errors) {
        $content = forgotPassword($formData, current($errors));
    }
    else {
        $resetPasswordModel = ModelFactory::get('ResetPasswordModel');
        $content = ($error = $resetPasswordModel->createToken($formData['email']))
            ? forgotPassword($formData, $error)
            : 'We emailed you directions for resetting your password.';
    }
}
else {
    $autofocus = autofocus('email');
    $content = forgotPassword($validator->values());
}

$head = '<title>Forgot Password</title>';

?>
