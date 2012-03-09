<?php

require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(CITY_PHP . 'html/HtmlHead.php');
require_once(EXAMPLE8_PHP . 'forms/ContactFormHandler.php');
require_once(EXAMPLE8_PHP . 'html/ContactFormHtmlBody.php');
require_once(EXAMPLE8_PHP . 'html/MessageHtmlBody.php');

$htmlBody = null;
$bodyTag = '<body>';
$formHandler = new ContactFormHandler();

if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $formValues = $formHandler->getValues();

    if(count($errors) > 0) {
        $htmlBody = new ContactFormHtmlBody($bodyTag, $formValues, current($errors));
    }
    else {
        $emailHeaders = 'From: ' . $formValues['xname'] . ' <' . $formValues['xemail'] . ">\r\n";
        $emailSuccess = mail(TO_EMAIL, 'Message #' . time(), $formValues['xmessage'], $emailHeaders);

        if($emailSuccess) {
            $htmlBody = new MessageHtmlBody('Your email was successfully sent. Thank you.');
        }
        else {
            $htmlBody = new ContactFormHtmlBody($bodyTag, $formValues,
                'An error occured while sending your email. Please try again in a few minutes.');
        }
    }
}
else {
    $bodyTag = '<body onLoad="document.getElementById(\'xname\').focus();">';
    $htmlBody = new ContactFormHtmlBody($bodyTag, $formHandler->getValues());
}

$tags = array('<title>Contact Form</title>',
    '<meta name="description" content=""/>',
    '<link type="text/css" rel="stylesheet" href="' . CSS . 'styles.css"/>');

$htmlHead = new HtmlHead($tags);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
