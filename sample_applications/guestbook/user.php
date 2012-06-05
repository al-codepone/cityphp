<?php

//
require_once(CITY_PHP . 'pagination/Paginator.php');
require_once(GUEST_BOOK_PHP . 'html/DisplayMessage.php');
require_once(GUEST_BOOK_PHP . 'html/MessageList.php');
require_once(GUEST_BOOK_PHP . 'html/Pagination.php');
require_once(GUEST_BOOK_PHP . 'html/User.php');

$userData = $databaseApi->getUserWithUsername($_GET['username']);
$titleTag = '<title>Unknown User</title>';

if($userData) {
    $currentPageNum = intval($_GET['p']);
    $numMessages = $databaseApi->getNumUserMessages($userData['user_id']);
    $paginator = new Paginator($numMessages, MESSAGES_PER_PAGE, $currentPageNum);
    $messages = $databaseApi->getUserMessages($paginator->getCurrentPageNum(), $userData['user_id']);
    $messageList = new MessageList($messages);
    $pagination = new Pagination($paginator->getNumPages(),
        $paginator->getCurrentPageNum(), USER . $userData['username'], '/');

    $content = new User($userData['username'], $messageList, $pagination);
    $titleTag = sprintf('<title>%s</title>', $userData['username']);
}
else {
    $content = new DisplayMessage('Unknown user.');
}

array_push($headTags, $titleTag, '<meta name="description" content=""/>');

?>
