<?php

require_once('./constants.php');
require_once(CITY_PHP . 'database/MySqlDatabaseHandle.php');

$words = array('123',
    "'green'",
    '"dog"',
    '&><\/"');

$databaseHandle = new MySqlDatabaseHandle(MYSQL_DATABASE_HOST,
    MYSQL_DATABASE_USERNAME,
    MYSQL_DATABASE_PASSWORD,
    MYSQL_DATABASE_NAME);

$query = sprintf('CREATE TABLE %s (
    word_id TINYINT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    word VARCHAR(64))',
    TABLE_WORDS);

$databaseHandle->writeQuery($query);

$query = sprintf('INSERT INTO %s
    (word_id, word) VALUES',
    TABLE_WORDS);

foreach($words as $i => $word) {
    $query .= $i > 0 ? ',' : '';
    $query .= sprintf('(NULL, "%s")',
        $databaseHandle->escapeString($word));
}

$databaseHandle->writeQuery($query);

$query = sprintf('SELECT word_id, word FROM %s', TABLE_WORDS);
foreach($databaseHandle->readQuery($query) as $row) {
    printf('%s=%s ', $row['word_id'], htmlspecialchars($row['word']));
}

?>
