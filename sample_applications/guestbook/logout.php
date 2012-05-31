<?php

session_start();

require_once('./constants.php');

unset($_SESSION[SESSION_USER_ID]);
header('Location: ' . ROOT);
exit();

?>
