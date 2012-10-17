<?php

require_once(VANILLA . 'forms/ForgotPasswordValidator.php');
require_once(VANILLA . 'html/autofocus.php');
require_once(VANILLA . 'html/forgotPassword.php');

$validator = new ForgotPasswordValidator();

if(list($formData, $errors) = $validator->validate()) {
    if(count($errors) > 0) {
        $content = forgotPassword($formData, current($errors));
    }
    else {
        $emailUserData = $userModel->getUserWithEmail($formData['email']);

        if($emailUserData) {
            $passwordResetModel = MyModelFactory::getModel('PasswordResetModel');
            $passwordResetModel->sendEmail($emailUserData['user_id'],
                $emailUserData['username'], $formData['email']);
        }

        $content = 'We emailed you directions for resetting your password.';
    }
}
else {
    $autofocus = autofocus('email');
    $content = forgotPassword($validator->values());
}

?>
