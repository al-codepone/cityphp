<?php

require_once(CITY_PHP . 'database/DatabaseHandle.php');

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
        $i = -1;
        $rows = array();
        $result = pg_query($this->getConn(), $query);

        if(!$result) {
            $this->databaseError();
        }

        while($row = pg_fetch_assoc($result)) { 
            ++$i;
            $rows[] = array();

            foreach($row as $key => $value) {
                $rows[$i][$key] = $value;
            }
        }

        return $rows;
    }

    public function escapeString($string) {
        return pg_escape_string($this->getConn(), $string);
    }
}

?>
