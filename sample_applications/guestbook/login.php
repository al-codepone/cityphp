<?php

//
require_once(GUEST_BOOK_PHP . 'forms/LoginFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/DisplayMessage.php');
require_once(GUEST_BOOK_PHP . 'html/Login.php');

//
$formHandler = new LoginFormHandler();

if($user) {
    $content = new DisplayMessage('You are already logged in.');
}
else if($formHandler->isReady()) {
    $formHandler->validate();
    $username = $formHandler->getValue('xusername');
    $password = $formHandler->getValue('xpassword');
    $userData = $databaseApi->getUserWithUsername($username);

    if(!$userData) {
        $content = new Login($username, 'Unknown username');
    }
    else if($userData['password'] != getHash($password, $userData['password'])) {
        $content = new Login($username, 'Incorrect password');
    }
    else {
        $_SESSION[SESSION_USER_ID] = $userData['user_id'];
        $_SESSION[SESSION_USERNAME] = $userData['username'];

        header('Location: ' . ROOT);
        exit();
    }
}
else {
    $content = new Login();
}

array_push($headTags, '<title>Login</title>',
   '<meta name="description" content=""/>');

?>
