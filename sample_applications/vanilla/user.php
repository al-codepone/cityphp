<?php

$userData = $userModel->getUserWithUsername($_GET['username']);
$content = $userData
    ? sprintf('%s\'s page', $userData['username'])
    : 'Unknown user';

?>
