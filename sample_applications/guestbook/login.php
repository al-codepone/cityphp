<?php

//
session_start();

//
require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(GUEST_BOOK_PHP . 'database/DatabaseApi.php');
require_once(GUEST_BOOK_PHP . 'forms/LoginFormHandler.php');
require_once(GUEST_BOOK_PHP . 'functions.php');
require_once(GUEST_BOOK_PHP . 'html/DisplayMessage.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlBody.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlHead.php');
require_once(GUEST_BOOK_PHP . 'html/Login.php');

//
$databaseApi = new DatabaseApi();
$user = $databaseApi->getLoggedInUser();
$formHandler = new LoginFormHandler();
$content = NULL;

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

//
$htmlHead = new GuestBookHtmlHead();
$htmlBody = new GuestBookHtmlBody($user, $content);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);

print $htmlDoc->draw();

?>
