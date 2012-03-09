<?php

require_once('./constants.php');
require_once(GUEST_BOOK_PHP . 'database/GuestBookDatabaseApiFactory.php');

$databaseApi = GuestBookDatabaseApiFactory::getDatabaseApi();
$databaseApi->install();

printf('Install successful. <a href="%s">Go to Guest Book</a>.', ROOT);

?>
