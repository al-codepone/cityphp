<?php

//
require_once(GUEST_BOOK_PHP . 'forms/ChangePasswordFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/ChangePassword.php');
require_once(GUEST_BOOK_PHP . 'html/DisplayMessage.php');

//
$formHandler = new ChangePasswordFormHandler();

if(!$user) {
    $content = new DisplayMessage('Login to change your password.');
}
else if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $formValues = $formHandler->getValues();
    $userData = $databaseApi->getUserWithUsername($user['username']);

    if(count($errors) > 0) {
        $content = new ChangePassword(current($errors));
    }
    else if($userData['password'] != getHash($formValues['xcurrpass'], $userData['password'])) {
        $content = new ChangePassword("Incorrect current password.");
    }
    else if($formValues['xnewpass'] != $formValues['xrepass']) {
        $content = new ChangePassword("New passwords didn't match.");
    }
    else {
        $passwordHash = getHash($formValues['xnewpass']);
        $databaseApi->updatePassword($passwordHash, $user['user_id']);
        $content = new DisplayMessage('Your password has been changed.', true);
    }
}
else {
    $content = new ChangePassword();
}

array_push($headTags, '<title>Change Password</title>',
   '<meta name="description" content=""/>');

?>
