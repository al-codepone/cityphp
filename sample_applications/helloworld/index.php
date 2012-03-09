<?php

require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(CITY_PHP . 'html/HtmlHead.php');
require_once(HELLO_WORLD_PHP . 'html/HelloWorldHtmlBody.php');

$tags = array('<title>Hello World</title>',
    '<meta name="description" content=""/>');

$htmlHead = new HtmlHead($tags);
$htmlBody = new HelloWorldHtmlBody();
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
