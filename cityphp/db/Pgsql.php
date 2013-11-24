<?php

namespace cityphp\db;

class Pgsql extends DatabaseHandle {
    public function __construct(
        $connectionString,
        $connectType = null,
        $errorMessage = 'database error',
        $debug = false)
    {
        $conn = pg_connect($connectionString, $connectType);
        parent::__construct($errorMessage, $debug, $conn);
    }

    public function query($query) {
        if(!pg_query($this->getConn(), $query)) {
            $this->error();
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

        $this->error();
    }

    public function esc($string) {
        return pg_escape_string($this->getConn(), $string);
    }

    protected function connError() {
        return pg_last_error($this->getConn());
    }
}

?>
