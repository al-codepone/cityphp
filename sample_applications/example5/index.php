<?php

require_once('./constants.php');
require_once(EXAMPLE5_PHP . 'html/MessageHtmlBody.php');
require_once(EXAMPLE5_PHP . 'html/MyHtmlDoc.php');
require_once(EXAMPLE5_PHP . 'html/MyHtmlHead.php');

$tags = array('<title>My Message</title>',
    '<meta name="description" content=""/>');

$htmlHead = new MyHtmlHead($tags);
$htmlBody = new MessageHtmlBody('This is my message.');
$htmlDoc = new MyHtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
