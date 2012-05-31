<?php

//
session_start();

//
require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(CITY_PHP . 'pagination/Paginator.php');
require_once(GUEST_BOOK_PHP . 'database/DatabaseApi.php');
require_once(GUEST_BOOK_PHP . 'forms/NewMessageFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlBody.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlHead.php');
require_once(GUEST_BOOK_PHP . 'html/Home.php');
require_once(GUEST_BOOK_PHP . 'html/MessageList.php');
require_once(GUEST_BOOK_PHP . 'html/Pagination.php');

//
$databaseApi = new DatabaseApi();
$user = $databaseApi->getLoggedInUser();
$formHandler = new NewMessageFormHandler();
$formError = '';

if($user && $formHandler->isReady()) {
    $errors = $formHandler->validate();

    if(count($errors) > 0) {
        $formError = current($errors);
    }
    else {
        $message = $formHandler->getValue('xmessage');
        $databaseApi->addMessage($message, $user['user_id']);
    }
}

$currentPageNum = intval($_GET['p']);
$paginator = new Paginator($databaseApi->getNumMessages(), MESSAGES_PER_PAGE, $currentPageNum);
$messages = $databaseApi->getMessages($paginator->getCurrentPageNum());
$messageList = new MessageList($messages);
$pagination = new Pagination($paginator->getNumPages(),
    $paginator->getCurrentPageNum(), ROOT, '?p=');

$home = new Home($user, $messageList, $pagination, $formError);
$headTags = array('<title>Guest Book</title>',
    '<link type="text/css" rel="stylesheet" href="' . CSS . 'home.css"/>',
    '<meta name="description" content=""/>');

//
$htmlHead = new GuestBookHtmlHead($headTags);
$htmlBody = new GuestBookHtmlBody($user, $home);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
