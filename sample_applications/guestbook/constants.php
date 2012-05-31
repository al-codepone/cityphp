<?php

define('CITY_PHP', '/somedir/cityphp/');
define('GUEST_BOOK_PHP', '/somedir/guestbookphp/');

define('ROOT', '/somedir/');
define('CSS', ROOT . 'css/');
define('MESSAGE', ROOT . 'message.php');
define('SIGN_UP', ROOT . 'signup.php');
define('LOGIN', ROOT . 'login.php');
define('LOG_OUT', ROOT . 'logout.php');
define('SETTINGS', ROOT . 'settings.php');

define('REGEX_USERNAME', '/^[a-z0-9]{4,16}$/i');
define('REGEX_PASSWORD', '/^.{6,100}$/');

define('DATABASE_HOST', 'host');
define('DATABASE_USERNAME', 'username');
define('DATABASE_PASSWORD', 'password');
define('DATABASE_NAME', 'database');

define('SESSION_USER_ID', 'user_id');
define('SESSION_USERNAME', 'username');

define('TABLE_MESSAGES', 'messages');
define('TABLE_USERS', 'users');

define('MESSAGES_PER_PAGE', 10);

?>
