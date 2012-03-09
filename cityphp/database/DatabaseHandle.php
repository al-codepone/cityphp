<?php

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

    abstract public function readQuery($query);
    abstract public function writeQuery($query);
    abstract public function escapeString($string);

    public function getConn() {
        return $this->conn;
    }

    public function databaseError() {
        die($this->errorMessage);
    }
}

?>
