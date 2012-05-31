<?php

//
session_start();

//
require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(GUEST_BOOK_PHP . 'database/DatabaseApi.php');
require_once(GUEST_BOOK_PHP . 'forms/SignUpFormHandler.php');
require_once(GUEST_BOOK_PHP . 'functions.php');
require_once(GUEST_BOOK_PHP . 'html/DisplayMessage.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlBody.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlHead.php');
require_once(GUEST_BOOK_PHP . 'html/SignUp.php');

//
$databaseApi = new DatabaseApi();
$user = $databaseApi->getLoggedInUser();
$formHandler = new SignUpFormHandler();
$content = NULL;

if($user) {
    $content = new DisplayMessage('You have already signed up.');
}
else if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $username = $formHandler->getValue('xusername');

    if(count($errors) > 0) {
        $content = new SignUp($username, current($errors));
    }
    else if($databaseApi->getUserWithUsername($username)) {
        $content = new SignUp($username, sprintf('"%s" already in use', $username));
    }
    else {
        $password = $formHandler->getValue('xpassword');
        $passwordHash = getHash($password);
        $databaseApi->addUser($username, $passwordHash);
        $content = new DisplayMessage('Thank you for signing up.');
    }
}
else {
    $content = new SignUp();
}

$htmlHead = new GuestBookHtmlHead();
$htmlBody = new GuestBookHtmlBody($user, $content);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);

print $htmlDoc->draw();

?>
