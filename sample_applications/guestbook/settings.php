<?php

require_once(GUEST_BOOK_PHP . 'forms/SettingsFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/settings.php');

$formHandler = new SettingsFormHandler();

if(!$user) {
    $content = 'Log in to access the settings page.';
}
else if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $formData = $formHandler->getValues();
    $userData = $userModel->getUserWithUsername($user['username']);
    $formUserData = $userModel->getUserWithUsername($formData['username']);

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
    else if($formUserData && $user['user_id'] != $formUserData['user_id']) {
        $content = settings($formData,
            sprintf('Username "%s" already in use', $formData['username']));
    }
    else {
        $userModel->updateUser($user['user_id'], $formData);
        $_SESSION[SESSION_USERNAME] = $user['username'] = $formData['username'];
        $content = 'Your settings have been updated.';
    }
}
else {
    $formData = $formHandler->getValues();
    $formData['username'] = $user['username'];
    $content = settings($formData);
}

$head = '<script src="' . JAVASCRIPT . 'settings.js"></script>'

?>
