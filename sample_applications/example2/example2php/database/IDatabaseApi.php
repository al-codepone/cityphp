<?php

interface IDatabaseApi {
    const TABLE_WORDS = 'words';

    public function install();
    public function selectWords();
    public function insertWords(array $words);
}

?>
