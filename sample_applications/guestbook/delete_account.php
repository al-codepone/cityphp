<?php

//
require_once(GUEST_BOOK_PHP . 'forms/DeleteAccountFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/DeleteAccount.php');
require_once(GUEST_BOOK_PHP . 'html/DisplayMessage.php');

//
$formHandler = new DeleteAccountFormHandler();

if(!$user) {
    $content = new DisplayMessage('Login to access the delete account page.');
}
else if($formHandler->isReady()) {
    $formHandler->validate();
    $password = $formHandler->getValue('xpassword');
    $userData = $databaseApi->getUserWithUsername($user['username']);

    if($userData['password'] != getHash($password, $userData['password'])) {
        $content = new DeleteAccount("Incorrect password.");
    }
    else {
        $databaseApi->deleteAccount($user['user_id']);
        $user = NULL;
        unset($_SESSION[SESSION_USER_ID]);
        $content = new DisplayMessage('Your account was successfully deleted.');
    }
}
else {
    $content = new DeleteAccount();
}

array_push($headTags, '<title>Delete Account</title>',
    '<script src="' . JAVASCRIPT . 'delete_account.js"></script>',    
    '<meta name="description" content=""/>');

?>
