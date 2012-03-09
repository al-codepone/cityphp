<?php

require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(EXAMPLE7_PHP . 'html/ContactFormView.php');
require_once(EXAMPLE7_PHP . 'html/Example7HtmlBody.php');
require_once(EXAMPLE7_PHP . 'html/Example7HtmlHead.php');

$bodyTag = '<body onLoad="document.getElementById(\'xname\').focus();">';
$contactFormView = new ContactFormView();
$htmlHead = new Example7HtmlHead('Contact Us');
$htmlBody = new Example7HtmlBody($bodyTag, $contactFormView);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
