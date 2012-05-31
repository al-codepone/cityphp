<?php

//
session_start();

//
require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(GUEST_BOOK_PHP . 'database/DatabaseApi.php');
require_once(GUEST_BOOK_PHP . 'forms/SettingsFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/DisplayMessage.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlBody.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlHead.php');
require_once(GUEST_BOOK_PHP . 'html/Settings.php');

//
$databaseApi = new DatabaseApi();
$user = $databaseApi->getLoggedInUser();
$formHandler = new SettingsFormHandler();
$content = NULL;

if(!$user) {
    $content = new DisplayMessage('Login to access the settings page.');
}
else if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $username = $formHandler->getValue('xusername');

    if(count($errors) > 0) {
        $content = new Settings($username, current($errors));
    }
    else {
        $userData = $databaseApi->getUserWithUsername($username);

        if($userData && $user['user_id'] != $userData['user_id']) {
            $content = new Settings($username, sprintf('"%s" already in use', $username));
        }
        else {
            $databaseApi->updateUsername($username, $user['user_id']);
            $_SESSION[SESSION_USERNAME] = $user['username'] = $username;
            $content = new DisplayMessage('Your username has been changed.');
        }
    }
}
else {
    $content = new Settings($user['username']);
}

//
$htmlHead = new GuestBookHtmlHead();
$htmlBody = new GuestBookHtmlBody($user, $content);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);

print $htmlDoc->draw();

?>