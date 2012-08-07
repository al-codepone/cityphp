<?php

session_start();

require_once('./constants.php');
require_once(GUEST_BOOK_PHP . 'database/DatabaseApi.php');

$databaseApi = new DatabaseApi();
$databaseApi->deletePersistentLogin();
unset($_SESSION[SESSION_USER_ID]);

header('Location:' . ROOT);
exit();

?>
