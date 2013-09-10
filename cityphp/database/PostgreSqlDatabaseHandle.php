<?php

namespace cityphp\database;

class PostgreSqlDatabaseHandle extends DatabaseHandle {
    public function __construct($connectionString,
                                $connectType = null,
                                $errorMessage = 'database error') {
        $conn = pg_connect($connectionString, $connectType);
        parent::__construct($errorMessage, $conn);
    }

    public function query($query) {
        if(!pg_query($this->getConn(), $query)) {
            $this->databaseError();
        }
    }

    public function fetchQuery($query) {
        if($result = pg_query($this->getConn(), $query)) {
            $rows = array();

            while($row = pg_fetch_assoc($result)) { 
                $rows[] = $row;
            }

            return $rows;
        }

        $this->databaseError();
    }

    public function esc($string) {
        return pg_escape_string($this->getConn(), $string);
    }
}

?>
