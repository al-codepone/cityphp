<?php

require_once(CITY_PHP . 'database/PostgreSqlDatabaseHandle.php');
require_once(EXAMPLE3_PHP . 'database/DatabaseApi.php');

class PostgreSqlDatabaseApi extends DatabaseApi {
    public function __construct(PostgreSqlDatabaseHandle $databaseHandle) {
        parent::__construct($databaseHandle);
    }

    public function insertWords(array $words) {
        foreach($words as $word) {
            $query = sprintf("INSERT INTO %s
                (word_id, word) VALUES(DEFAULT, '%s')",
                self::TABLE_WORDS,
                $this->escapeString($word));

            $this->writeQuery($query);
        }
    }

    protected function getWordIDType() {
        return 'SERIAL PRIMARY KEY';
    }
}

?>
