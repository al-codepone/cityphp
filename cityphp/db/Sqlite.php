<?php

namespace cityphp\db;

class Sqlite extends DatabaseHandle {
    public function __construct(
        $filename,
        $flags = 6,
        $encryptionKey = '',
        $errorMessage = 'database error',
        $debug = false)
    {
        $conn = new \SQLite3($filename, $flags, $encryptionKey);
        parent::__construct($errorMessage, $debug, $conn);
    }

    public function exec($query) {
        if(!$this->getConn()->exec($query)) {
            $this->error();
        }
    }

    public function query($query) {
        if($result = $this->getConn()->query($query)) {
            $rows = array();

            while($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $rows[] = $row;
            }

            return $rows;
        }

        $this->error();
    }

    public function esc($string) {
        return \SQLite3::escapeString($string);
    }

    protected function connError() {
        return $this->getConn()->lastErrorMsg();
    }
}

?>
