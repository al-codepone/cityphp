<?php

require_once(CITY_PHP . 'IView.php');

class Pagination implements IView {
    private $numPages;
    private $currentPageNum;
	private $urlBase;
    private $urlFragment;

    public function __construct($numPages, $currentPageNum, $urlBase, $urlFragment) {
        $this->numPages = $numPages;
        $this->currentPageNum = $currentPageNum;
		$this->urlBase = $urlBase;
		$this->urlFragment = $urlFragment;
    }

    public function draw() {
        $ob = '';

        if($this->numPages > 1) {
            $ob .= '<div>';

            for($i = 1; $i <= $this->numPages; ++$i) {
                $isCurrent = ($i == $this->currentPageNum);

                if($isCurrent) {
                    $ob .= $i;
                }
                else {
                    $queryString = $i > 1 ? $this->urlFragment . $i : '';
                    $ob .= sprintf('<a href="%s%s">%s</a>',
                        $this->urlBase, $queryString, $i);
                }

                $ob .= ' ';
            }

            $ob .= '</div>';
        }

        return $ob;
    }
}

?>
