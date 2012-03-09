<?php

require_once(CITY_PHP . 'database/DatabaseHandle.php');

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

    public function readQuery($query) {
        $i = -1;
        $rows = array();
        $result = mysqli_query($this->getConn(), $query);

        if(!$result) {
            $this->databaseError();
        }

        while($row = mysqli_fetch_assoc($result)) { 
            ++$i;
            $rows[] = array();

            foreach($row as $key => $value) {
                $rows[$i][$key] = $value;
            }
        }

        return $rows;
    }

    public function writeQuery($query) {
        if(!mysqli_query($this->getConn(), $query)) {
            $this->databaseError();
        }
    }

    public function escapeString($string) {
        return mysqli_real_escape_string($this->getConn(), $string);
    }
}

?>
