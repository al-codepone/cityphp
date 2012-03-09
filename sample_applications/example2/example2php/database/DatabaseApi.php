<?php

require_once(CITY_PHP . 'database/PostgreSqlDatabaseHandle.php');
require_once(EXAMPLE2_PHP . 'database/IDatabaseApi.php');

class DatabaseApi extends PostgreSqlDatabaseHandle implements IDatabaseApi {
    public function __construct() {
        parent::__construct(PGSQL_DATABASE_CONNECTION_STRING);
    }

    public function install() {
        $query = sprintf('CREATE TABLE %s (
            word_id SERIAL PRIMARY KEY,
            word VARCHAR(64))',
            self::TABLE_WORDS);

        $this->writeQuery($query);
    }

    public function selectWords() {
        $query = sprintf('SELECT word_id, word FROM %s', self::TABLE_WORDS);
        return $this->readQuery($query);
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
}

?>
