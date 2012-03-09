<?php

require_once(CITY_PHP . 'IView.php');
require_once(CITY_PHP . 'pagination/Paginator.php');

class PaginationView implements IView {
    private $paginator;

    public function __construct(Paginator $paginator) {
        $this->paginator = $paginator;
    }

    public function draw() {
        $ob = '<div class="pagination">';

        for($i = 1; $i <= $this->paginator->getNumPages(); ++$i) {
            $isCurrent = ($i == $this->paginator->getCurrentPageNum());
            $divId = $isCurrent ? ' id="current"' : '';
            $queryString = ($i != 1) ? '?p=' . $i : '';

            $ob .= sprintf('<div%s><a href="%s%s">%d</a></div>',
                $divId, ROOT, $queryString, $i);
        }

        $ob .= '</div>';
        return $ob;
    }
}

?>
