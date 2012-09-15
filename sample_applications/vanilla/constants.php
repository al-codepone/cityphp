<?php

define('CITYPHP', 'C:/wamp/www/framework/cityphp/');
define('VANILLA', 'C:/wamp/www/framework/sample_applications/vanilla/vanilla/');

define('ROOT', '/framework/sample_applications/vanilla/');
define('CSS', ROOT . 'css/');
define('JAVASCRIPT', ROOT . 'javascript/');
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

define('COOKIE_PERSISTENT_LOGIN', 'persistent_login');

define('TABLE_USERS', 'users');
define('TABLE_PERSISTENT_LOGIN_TOKENS', 'persistent_login_tokens');

define('PERSISTENT_LOGIN_DAYS', 7);

?>
