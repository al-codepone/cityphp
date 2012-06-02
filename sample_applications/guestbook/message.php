<?php

//
require_once(GUEST_BOOK_PHP . 'html/DisplayMessage.php');
require_once(GUEST_BOOK_PHP . 'html/Message.php');

//
$messageID = intval($_GET['id']);
$currentMessage = $databaseApi->getMessage($messageID);
$content = $currentMessage
    ? new Message($currentMessage)
    : new DisplayMessage('Invalid message');

$titleTag = $currentMessage
    ? '<title>Message #' . $currentMessage['message_id'] . '</title>'
    : '<title>Invalid Message</title>';

array_push($headTags, $titleTag, '<meta name="description" content=""/>');

?>
