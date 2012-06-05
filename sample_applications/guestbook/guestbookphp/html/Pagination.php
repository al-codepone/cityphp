<?php

require_once(CITY_PHP . 'IView.php');

class Pagination implements IView {
    private $numPages;
    private $currentPageNum;
    private $urlBase;
    private $urlEnd;

    public function __construct($numPages, $currentPageNum, $urlBase, $urlEnd = '') {
        $this->numPages = $numPages;
        $this->currentPageNum = $currentPageNum;
        $this->urlBase = $urlBase;
        $this->urlEnd = $urlEnd;
    }

    public function draw() {
        $ob = '';

        if($this->numPages > 1) {
            $ob .= '<div class="pagination">';

            for($i = 1; $i <= $this->numPages; ++$i) {
                $isCurrent = ($i == $this->currentPageNum);

                if($isCurrent) {
                    $ob .= $i;
                }
                else {
                    $pageFragment = $i > 1 ? $this->urlEnd . $i : '';
                    $ob .= sprintf('<a href="%s%s">%s</a>',
                        $this->urlBase, $pageFragment, $i);
                }

                $ob .= ' ';
            }

            $ob .= '</div>';
        }

        return $ob;
    }
}

?>
