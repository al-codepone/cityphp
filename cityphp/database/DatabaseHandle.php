<?php

namespace cityphp\database;

abstract class DatabaseHandle {
    private $errorMessage;
    private $conn;

    public function __construct($errorMessage, $conn) {
        $this->errorMessage = $errorMessage;

        if(!$conn) {
            $this->databaseError();
        }

        $this->conn = $conn;
    }

    abstract public function query($query);
    abstract public function fetchQuery($query);
    abstract public function esc($string);

    public function getConn() {
        return $this->conn;
    }

    public function databaseError() {
        die($this->errorMessage);
    }
}

?>
