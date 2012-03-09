<?php

require_once('./constants.php');
require_once(EXAMPLE3_PHP . 'database/DatabaseApiFactory.php');

$words = array('123',
    "'green'",
    '"dog"',
    '&><\/"');

$databaseApi = DatabaseApiFactory::getDatabaseApi();
$databaseApi->install();
$databaseApi->insertWords($words);

foreach($databaseApi->selectWords() as $row) {
    printf('%s=%s ', $row['word_id'], htmlspecialchars($row['word']));
}

?>
