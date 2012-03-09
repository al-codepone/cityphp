<?php

require_once(CITY_PHP . 'database/DatabaseAdapter.php');
require_once(EXAMPLE3_PHP . 'database/IDatabaseApi.php');

abstract class DatabaseApi extends DatabaseAdapter implements IDatabaseApi {
    public function install() {
        $query = sprintf('CREATE TABLE %s (
            word_id %s,
            word VARCHAR(64))',
            self::TABLE_WORDS,
            $this->getWordIDType());

        $this->writeQuery($query);
    }

    public function selectWords() {
        $query = sprintf('SELECT word_id, word FROM %s', self::TABLE_WORDS);
        return $this->readQuery($query);
    }

    abstract protected function getWordIDType();
}

?>
