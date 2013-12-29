<?php

require 'vendor/autoload.php';
 
$numItems = 87;
$itemsPerPage = 10;
$rawCurrentPageNum = 20;
 
list($numPages, $currentPageNum) = 
    paginate($numItems, $itemsPerPage, $rawCurrentPageNum);
 
printf('num pages = %d, current page num = %d',
    $numPages, $currentPageNum);

?>
