<?php

require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(CITY_PHP . 'html/HtmlHead.php');
require_once(CITY_PHP . 'pagination/Paginator.php');
require_once(EXAMPLE10_PHP . 'html/PaginationView.php');
require_once(EXAMPLE10_PHP . 'html/SingleViewHtmlBody.php');

$currentPageNum = intval($_GET['p']);
$numItems = 50;
$paginator = new Paginator($numItems, ITEMS_PER_PAGE, $currentPageNum);
$paginationView = new PaginationView($paginator);

$tags = array('<title>Paginator Test</title>',
    '<meta name="description" content=""/>',
    '<link type="text/css" rel="stylesheet" href="' . CSS . 'styles.css"/>');

$htmlHead = new HtmlHead($tags);
$htmlBody = new SingleViewHtmlBody($paginationView);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
