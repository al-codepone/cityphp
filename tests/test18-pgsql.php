<?php

require 'const.php';
require 'vendor/autoload.php';

$db = new cityphp\db\Pgsql(
    PGSQL_CONN_STRING,
    null,
    'my database error',
    DB_DEBUG);

$db->exec('CREATE TABLE ' . TABLE_WORDS . ' (
    word_id SERIAL PRIMARY KEY,
    word VARCHAR(64))');

$db->exec(sprintf("INSERT INTO %s (word) VALUES('jump')",
    TABLE_WORDS));

$db->exec(sprintf("INSERT INTO %s (word) VALUES('%s')",
    TABLE_WORDS,
    $db->esc('&><\/\'')));

var_dump($db->query('SELECT * FROM ' . TABLE_WORDS));

?>
