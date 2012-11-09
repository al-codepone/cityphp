<?php

function paginate($numItems, $itemsPerPage, $currentPageNum) {
    $numPages = max(1, ceil($numItems/$itemsPerPage));
    $currentPageNum = $currentPageNum > 0 ? $currentPageNum <= $numPages
        ? $currentPageNum : $numPages : 1;

    return array($numPages, $currentPageNum);
}

?>
