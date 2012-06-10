<?php

define('CITY_PHP', 'C:/wamp/www/framework/cityphp/');
define('GUEST_BOOK_PHP', 'C:/wamp/www/framework/sample_applications/guestbook/guestbookphp/');

define('ROOT', '/framework/sample_applications/guestbook/');
define('CSS', ROOT . 'css/');
define('JAVASCRIPT', ROOT . 'javascript/');
define('MESSAGE', ROOT . 'message/');
define('USER', ROOT . 'user/');
define('SIGN_UP', ROOT . 'signup');
define('LOGIN', ROOT . 'login');
define('LOG_OUT', ROOT . 'logout');
define('SETTINGS', ROOT . 'settings');

define('REGEX_USERNAME', '/^[a-z0-9]{4,16}$/i');
define('REGEX_PASSWORD', '/^.{6,100}$/');

define('DATABASE_HOST', 'localhost');
define('DATABASE_USERNAME', 'big');
define('DATABASE_PASSWORD', 'tree');
define('DATABASE_NAME', 'myfirstdb');

define('SESSION_USER_ID', 'user_id');
define('SESSION_USERNAME', 'username');

define('TABLE_MESSAGES', 'messages');
define('TABLE_USERS', 'users');

define('MESSAGES_PER_PAGE', 5);

?>
