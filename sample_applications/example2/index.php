<?php

require_once('./constants.php');
require_once(EXAMPLE2_PHP . 'database/DatabaseApi.php');

$words = array('123',
    "'green'",
    '"dog"',
    '&><\/"');

$databaseApi = new DatabaseApi();
$databaseApi->install();
$databaseApi->insertWords($words);

foreach($databaseApi->selectWords() as $row) {
    printf('%s=%s ', $row['word_id'], htmlspecialchars($row['word']));
}

?>
