<?php

require_once 'const.php';
require_once CITYPHP . '__autoload.php';

use cityphp\db\Sqlite;

$db = new Sqlite(
    SQLITE_FILENAME,
    SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE,
    '',
    'my database error',
    DB_DEBUG);

$db->exec('CREATE TABLE ' . TABLE_WORDS . ' (word TEXT)');

$db->exec(sprintf("INSERT INTO %s (word)
    SELECT 'was' AS 'word'
    UNION SELECT 'jump'
    UNION SELECT 'hello'",
    TABLE_WORDS));

$db->exec(sprintf("INSERT INTO %s (word) VALUES('%s')",
    TABLE_WORDS,
    $db->esc('&><\/\'')));

var_dump($db->query('SELECT rowid, word FROM ' . TABLE_WORDS));

?>
