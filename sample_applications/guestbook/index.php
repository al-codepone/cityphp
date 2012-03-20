<?php

//
require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(CITY_PHP . 'pagination/Paginator.php');
require_once(GUEST_BOOK_PHP . 'database/DatabaseApi.php');
require_once(GUEST_BOOK_PHP . 'forms/NewMessageFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/GuestBookHtmlHead.php');
require_once(GUEST_BOOK_PHP . 'html/IndexHtmlBody.php');

//
$databaseApi = new DatabaseApi();
$formHandler = new NewMessageFormHandler();
$isAutofocus = true;
$formError = '';
$formMessage = '';

if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $message = $formHandler->getValue('xmessage');

    if(count($errors) > 0) {
        $isAutofocus = false;
        $formError = current($errors);
        $formMessage = $message;
    }
    else {
        $databaseApi->addMessage($message);
    }
}

$currentPageNum = intval($_GET['p']);
$paginator = new Paginator($databaseApi->getNumMessages(), MESSAGES_PER_PAGE, $currentPageNum);
$headTags = array('<title>Guest Book</title>',
    '<link type="text/css" rel="stylesheet" href="' . CSS . 'index.css"/>',
    '<meta name="description" content=""/>');

//
$htmlHead = new GuestBookHtmlHead($headTags);
$htmlBody = new IndexHtmlBody($isAutofocus,
    $paginator->getNumPages(),
	$paginator->getCurrentPageNum(),
    $databaseApi->getMessages($paginator->getCurrentPageNum()),
    $formError,
    $formMessage);

$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
