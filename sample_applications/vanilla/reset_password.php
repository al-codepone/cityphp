<?php

require_once(VANILLA . 'forms/ResetPasswordFormHandler.php');
require_once(VANILLA . 'html/autofocus.php');
require_once(VANILLA . 'html/resetPassword.php');

$passwordResetModel = MyModelFactory::getModel('PasswordResetModel');
$data = $passwordResetModel->getToken($_GET['id'], $_GET['token']);

if($data) {
    $formHandler = new ResetPasswordFormHandler();

    if($formHandler->isReady()) {
        $errors = $formHandler->validate();
        $formData = $formHandler->getValues();

        if(count($errors) > 0) {
            $content = resetPassword($formData, current($errors));
        }
        else if($formData['password'] != $formData['confirm_password']) {
            $content = resetPassword($formData, "Passwords didn't match.");
        }
        else {
            $userModel->updatePassword($data['user_id'], $formData['password']);
            $passwordResetModel->deleteToken($data['token_id']);
            $content = 'Your password was successfully reset.';
        }
    }
    else {
        $autofocus = autofocus('password');
        $content = resetPassword($formHandler->getValues());
    }
}
else {
    $content = 'Invalid password reset.';
}

?>
