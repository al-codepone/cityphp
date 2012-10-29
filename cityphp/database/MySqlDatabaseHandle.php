<?php

require_once(CITYPHP . 'database/DatabaseHandle.php');

class MySqlDatabaseHandle extends DatabaseHandle {
    public function __construct($host = null,
                                $username = null,
                                $password = null,
                                $databaseName = '',
                                $port = null,
                                $socket = null,
                                $errorMessage = 'database error') {
        $conn = mysqli_connect($host, $username, $password, $databaseName, $port, $socket);
        parent::__construct($errorMessage, $conn);
    }

    public function query($query) {
        if(!mysqli_query($this->getConn(), $query)) {
            $this->databaseError();
        }
    }

    public function fetchQuery($query) {
        if($result = mysqli_query($this->getConn(), $query)) {
            $rows = array();

            while($row = mysqli_fetch_assoc($result)) { 
                $rows[] = $row;
            }

            return $rows;
        }

        $this->databaseError();
    }

    public function esc($string) {
        return mysqli_real_escape_string($this->getConn(), $string);
    }
}

?>
