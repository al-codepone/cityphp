<?php

namespace cityphp\db;

class Mysql extends DatabaseHandle {
    public function __construct(
        $host = null,
        $username = null,
        $password = null,
        $databaseName = '',
        $port = null,
        $socket = null,
        $errorMessage = 'database error',
        $debug = false)
    {
        $conn = mysqli_connect($host, $username, $password, $databaseName, $port, $socket);
        parent::__construct($errorMessage, $debug, $conn);
    }

    public function query($query) {
        if(!mysqli_query($this->getConn(), $query)) {
            $this->error();
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

        $this->error();
    }

    public function esc($string) {
        return mysqli_real_escape_string($this->getConn(), $string);
    }

    protected function connError() {
        return $this->getConn()->error;
    }
}

?>
