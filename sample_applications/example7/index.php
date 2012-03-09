<?php

require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(EXAMPLE7_PHP . 'html/Example7HtmlBody.php');
require_once(EXAMPLE7_PHP . 'html/Example7HtmlHead.php');
require_once(EXAMPLE7_PHP . 'html/TextView.php');

$homeView = new TextView('Hi, welcome to my website.');
$htmlHead = new Example7HtmlHead('Home');
$htmlBody = new Example7HtmlBody('<body>', $homeView);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
