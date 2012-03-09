<?php

class Paginator {
    private $numPages;
    private $currentPageNum;

    public function __construct($numItems, $itemsPerPage, $currentPageNum) {
        $this->numPages = max(1, ceil($numItems/$itemsPerPage));
        $this->currentPageNum = $currentPageNum;

        if($this->currentPageNum < 1) {
            $this->currentPageNum = 1;
        }
        else if($this->currentPageNum > $this->numPages) {
            $this->currentPageNum = $this->numPages;
        }
    }

    public function getNumPages() {
        return $this->numPages;
    }

    public function getCurrentPageNum() {
        return $this->currentPageNum;
    }
}

?>
