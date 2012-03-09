<?php

require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(CITY_PHP . 'html/HtmlHead.php');
require_once(EXAMPLE6_PHP . 'html/FormHtmlBody.php');

$bodyTag = $_GET['word'] == 'focus'
    ? '<body onLoad="document.getElementById(\'xinput\').focus();">'
    : '<body>';

$tags = array('<title>Autofocus Test</title>',
    '<meta name="description" content=""/>');

$htmlHead = new HtmlHead($tags);
$htmlBody = new FormHtmlBody($bodyTag);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
