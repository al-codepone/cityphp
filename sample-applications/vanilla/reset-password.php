<?php

require_once(VANILLA . 'forms/ResetPasswordValidator.php');
require_once(VANILLA . 'html/autofocus.php');
require_once(VANILLA . 'html/resetPassword.php');

$resetPasswordModel = MyModelFactory::getModel('ResetPasswordModel');
$data = $resetPasswordModel->getToken($_GET['id'], $_GET['token']);

if($data) {
    $validator = new ResetPasswordValidator();

    if(list($formData, $errors) = $validator->validate()) {
        if(count($errors) > 0) {
            $content = resetPassword($formData, current($errors));
        }
        else if($formData['password'] != $formData['confirm_password']) {
            $content = resetPassword($formData, "Passwords didn't match.");
        }
        else {
            $userModel->updatePassword($data['user_id'], $formData['password']);
            $resetPasswordModel->deleteToken($data['token_id']);
            $content = 'Your password was successfully reset.';
        }
    }
    else {
        $autofocus = autofocus('password');
        $content = resetPassword($validator->values());
    }
}
else {
    $content = 'Invalid password reset.';
}

?>
