<?php

require_once(CITY_PHP . 'database/MySqlDatabaseHandle.php');
require_once(EXAMPLE3_PHP . 'database/DatabaseApi.php');

class MySqlDatabaseApi extends DatabaseApi {
    public function __construct(MySqlDatabaseHandle $databaseHandle) {
        parent::__construct($databaseHandle);
    }

    public function insertWords(array $words) {
        $query = sprintf('INSERT INTO %s
            (word_id, word) VALUES',
            self::TABLE_WORDS);

        foreach($words as $i => $word) {
            $query .= $i > 0 ? ',' : '';
            $query .= sprintf('(NULL, "%s")',
                $this->escapeString($word));
        }

        $this->writeQuery($query);
    }

    protected function getWordIDType() {
        return 'TINYINT AUTO_INCREMENT NOT NULL PRIMARY KEY';
    }
}

?>
