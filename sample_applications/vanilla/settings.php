<?php

require_once(VANILLA . 'forms/SettingsFormHandler.php');
require_once(VANILLA . 'html/settings.php');

$formHandler = new SettingsFormHandler();

if(!$user) {
    $content = 'Log in to access the settings page.';
}
else if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $formData = $formHandler->getValues();
    $userData = $userModel->getUserWithUID($user['user_id']);
    $usernameUserData = $userModel->getUserWithUsername($formData['username']);
    $emailUserData = $userModel->getUserWithEmail($formData['email']);

    if($userData['password'] != getHash($formData['current_password'], $userData['password'])) {
        $content = settings($formData, 'Incorrect current password');
    }
    else if($formData['delete_flag']) {
        $userModel->deleteUser($user['user_id']);
        $user = null;
        unset($_SESSION[SESSION_USER_ID]);
        $content = 'Your account was successfully deleted.';
    }
    else if(count($errors) > 0) {
        $content = settings($formData, current($errors));
    }
    else if($formData['new_password'] != $formData['confirm_password']) {
        $content = settings($formData, "New passwords didn't match.");
    }
    else if($usernameUserData && $user['user_id'] != $usernameUserData['user_id']) {
        $content = settings($formData,
            sprintf('Username "%s" already in use', $formData['username']));
    }
    else if($emailUserData && $user['user_id'] != $emailUserData['user_id']) {
        $content = settings($formData,
            sprintf('Email "%s" already in use', $formData['email']));
    }	
    else {
        $isNewEmail = !$userData['email'] && $formData['email'];
        $isDeletedEmail = $userData['email'] && !$formData['email'];
        $isChangedEmail = $userData['email'] && $formData['email']
            && $userData['email'] != $formData['email'];

        if($isNewEmail || $isChangedEmail) {
            $verifyEmailModel = MyModelFactory::getModel('VerifyEmailModel');
            $verifyEmailModel->sendEmail($user['user_id'], $formData['username'],
                $formData['email']);
        }

        if($isDeletedEmail || $isChangedEmail) {
            $userModel->updateEmail($user['user_id'], '');
        }

        $userModel->updateUser($user['user_id'], $formData);
        $_SESSION[SESSION_USERNAME] = $user['username'] = $formData['username'];

        $content = sprintf('Your settings have been updated.%s',
            !$isChangedEmail ? !$isNewEmail ? !$isDeletedEmail ? ''
                : ' Your email was removed from your account.'
                : ' We emailed you a link to verify your email.'
                : ' We emailed you a link to verify your updated email.'
                    . ' Your old email was removed from your account.');
    }
}
else {
    $userData = $userModel->getUserWithUID($user['user_id']);
    $formData = $formHandler->getValues();
    $formData['username'] = $userData['username'];
    $formData['email'] = $userData['email'];
    $content = settings($formData);
}

$head = '<script src="' . JAVASCRIPT . 'settings.js"></script>';

?>
