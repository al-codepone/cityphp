<?php

//
require_once(GUEST_BOOK_PHP . 'forms/SettingsFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/DisplayMessage.php');
require_once(GUEST_BOOK_PHP . 'html/Settings.php');

//
$formHandler = new SettingsFormHandler();

if(!$user) {
    $content = new DisplayMessage('Login to access the settings page.');
}
else if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $formValues = $formHandler->getValues();
    $userData = $databaseApi->getUserWithUsername($user['username']);
    $formUserData = $databaseApi->getUserWithUsername($formValues['xusername']);

    if($userData['password'] != getHash($formValues['xcurrentpassword'], $userData['password'])) {
        $content = new Settings($formValues['xusername'], 'Incorrect current password');
    }
    else if($formValues['xdeleteflag']) {
        $databaseApi->deleteAccount($user['user_id']);
        $user = NULL;
        unset($_SESSION[SESSION_USER_ID]);
        $content = new DisplayMessage('Your account was successfully deleted.');
    }
    else if(count($errors) > 0) {
        $content = new Settings($formValues['xusername'], current($errors));
    }
    else if($formValues['xnewpassword'] != $formValues['xconfirmpassword']) {
        $content = new Settings($formValues['xusername'], "New passwords didn't match.");
    }
    else if($formUserData && $user['user_id'] != $formUserData['user_id']) {
        $content = new Settings($formValues['xusername'], sprintf('"%s" already in use', $formValues['xusername']));
    }
    else {
        if($formValues['xnewpassword']) {
            $passwordHash = getHash($formValues['xnewpassword']);
            $databaseApi->updatePassword($passwordHash, $user['user_id']);
        }

        $databaseApi->updateUsername($formValues['xusername'], $user['user_id']);
        $_SESSION[SESSION_USERNAME] = $user['username'] = $formValues['xusername'];
        $content = new DisplayMessage('Your settings have been updated.');
    }
}
else {
    $content = new Settings($user['username']);
}

array_push($headTags, '<title>Settings</title>',
    '<script src="' . JAVASCRIPT . 'settings.js"></script>',
    '<meta name="description" content=""/>');

?>
