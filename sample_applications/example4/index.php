<?php

require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(CITY_PHP . 'html/HtmlHead.php');
require_once(EXAMPLE4_PHP . 'html/MessageHtmlBody.php');

$tags = array('<title>My Message</title>',
    '<meta name="description" content=""/>');

$htmlHead = new HtmlHead($tags);
$htmlBody = new MessageHtmlBody('This is my message.');
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
