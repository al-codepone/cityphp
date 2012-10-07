<?php

require_once(VANILLA . 'forms/ForgotPasswordFormHandler.php');
require_once(VANILLA . 'html/forgotPassword.php');

$formHandler = new ForgotPasswordFormHandler();

if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $formData = $formHandler->getValues();

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
    $content = forgotPassword($formHandler->getValues());
}

?>
