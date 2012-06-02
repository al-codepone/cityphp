<?php

//
session_start();

//
require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(GUEST_BOOK_PHP . 'database/DatabaseApi.php');
require_once(GUEST_BOOK_PHP . 'functions.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlBody.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlHead.php');

//
$databaseApi = new DatabaseApi();
$user = $databaseApi->getLoggedInUser();
$headTags = array();
$content = NULL;

$routes = array(NULL => 'home.php',
'signup' => 'signup.php',
'login' => 'login.php',
'settings' => 'settings.php',
'message' => 'message.php');

require_once(getRoute($routes));

//
$htmlHead = new GuestBookHtmlHead($headTags);
$htmlBody = new GuestBookHtmlBody($user, $content);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
