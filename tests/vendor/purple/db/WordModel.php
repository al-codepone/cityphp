<?php

namespace purple\db;

use cityphp\db\DatabaseAdapter;

class WordModel extends DatabaseAdapter {
    public function install() {
        $this->exec('CREATE TABLE ' . TABLE_WORDS . ' (
            word_id INT AUTO_INCREMENT PRIMARY KEY,
            word VARCHAR(32))');
    }

    public function create(array $words) {
        if($words) {
            $this->exec(sprintf('INSERT INTO %s (word) VALUES("%s")',
                TABLE_WORDS,
                implode('"), ("', array_map(array($this, 'esc'), $words))));
        }
    }

    public function get() {
        return $this->query('SELECT * FROM ' . TABLE_WORDS);
    }

    public function update($from, $to) {
        $this->exec(sprintf('UPDATE %s SET word = "%s" WHERE word = "%s"',
            TABLE_WORDS,
            $this->esc($to),
            $this->esc($from)));
    }

    public function delete($word) {
        $this->exec(sprintf('DELETE FROM %s WHERE word = "%s"',
            TABLE_WORDS,
            $this->esc($word)));
    }
}

?>
