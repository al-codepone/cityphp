<?php

//this constant is for autoloading files
//it must be named VENDOR
//list each directory that contains at least one namespaced package
//separate directories with whitespace
//each directory must be an absolute path
define('VENDOR', 'C:/wamp/www/cityphp/ C:/wamp/www/cityphp/tests/vendor/');

//these constants are for manually loading files
//use one for each directory in the vendor directories
//you must use one named CITYPHP
//each of these must be a single absolute path, not multiple
define('CITYPHP', 'C:/wamp/www/cityphp/cityphp/');
define('PURPLE', 'C:/wamp/www/cityphp/tests/vendor/purple/');

define('MYSQL_HOST', 'localhost');
define('MYSQL_USERNAME', 'ryry');
define('MYSQL_PASSWORD', 'ryry');
define('MYSQL_DBNAME', 'test2');
define('PGSQL_CONN_STRING', 'dbname=example2 user=postgres password=postgres');
define('SQLITE_FILENAME', 'mydb.db');
define('DB_DEBUG', true);

define('TABLE_EVENTS', 'events');
define('TABLE_WORDS', 'words');

?>
