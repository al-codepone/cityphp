<?php

//
require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(GUEST_BOOK_PHP . 'database/DatabaseApi.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlHead.php');
require_once(GUEST_BOOK_PHP . 'html/MessageHtmlBody.php');

//
$messageID = intval($_GET['id']);
$databaseApi = new DatabaseApi();
$currentMessage = $databaseApi->getMessage($messageID);
$titleTag = $currentMessage->message_id != -1
    ? '<title>Message #' . $currentMessage->message_id . '</title>'
    : '<title>Invalid Message</title>';

$headTags = array($titleTag,
    '<link type="text/css" rel="stylesheet" href="' . CSS . 'message.css"/>',
    '<meta name="description" content=""/>');

//
$htmlHead = new GuestBookHtmlHead($headTags);
$htmlBody = new MessageHtmlBody($currentMessage);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
