<?php

require_once('./constants.php');
require_once(CITY_PHP . 'pagination/Paginator.php');

$paginators = array(new Paginator(100, 10, 1),
    new Paginator(100, 10, 20),
    new Paginator(100, 10, -20),
    new Paginator(0, 10, 2));

foreach($paginators as $paginator) {
    printf('numPages = %d, currentPageNum = %d<br/>',
        $paginator->getNumPages(),
        $paginator->getCurrentPageNum());
}

?>
