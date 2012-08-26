<?php

require_once(CITYPHP . 'database/DatabaseHandle.php');

abstract class DatabaseAdapter {
    private $databaseHandle;

    public function __construct(DatabaseHandle $databaseHandle) {
        $this->databaseHandle = $databaseHandle;
    }

    protected function query($query) {
        $this->databaseHandle->query($query);
    }

    protected function fetchQuery($query) {
        return $this->databaseHandle->fetchQuery($query);
    }

    protected function esc($string) {
        return $this->databaseHandle->esc($string);
    }

    protected function getConn() {
        return $this->databaseHandle->getConn();
    }

    protected function databaseError() {
        $this->databaseHandle->databaseError();
    }
}

?>
