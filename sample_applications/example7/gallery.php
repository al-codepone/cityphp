<?php

require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(EXAMPLE7_PHP . 'html/Example7HtmlBody.php');
require_once(EXAMPLE7_PHP . 'html/Example7HtmlHead.php');
require_once(EXAMPLE7_PHP . 'html/GalleryView.php');

$imageUris = array(IMAGE . 'm31.jpg',
    IMAGE . 'bunny.jpg',
    IMAGE . 'mona_lisa.jpg');

$galleryView = new GalleryView($imageUris);
$htmlHead = new Example7HtmlHead('Photo Gallery');
$htmlBody = new Example7HtmlBody('<body>', $galleryView);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
