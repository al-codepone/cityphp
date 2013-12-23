<?php

function paginate($numItems, $itemsPerPage, $currentPageNum) {
    $numPages = max(1, ceil($numItems/$itemsPerPage));
    $currentPageNum = clamp($currentPageNum, 1, $numPages);
    return array($numPages, $currentPageNum);
}

?>
