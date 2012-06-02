<?php

//
require_once(CITY_PHP . 'pagination/Paginator.php');
require_once(GUEST_BOOK_PHP . 'forms/NewMessageFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/Home.php');
require_once(GUEST_BOOK_PHP . 'html/MessageList.php');
require_once(GUEST_BOOK_PHP . 'html/Pagination.php');

//
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

$content = new Home($user, $messageList, $pagination, $formError);
array_push($headTags, '<title>Guest Book</title>',
   '<meta name="description" content=""/>');

?>
