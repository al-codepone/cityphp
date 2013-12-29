<?php

require 'const.php';
require 'vendor/autoload.php';

//connect to db
$db = new cityphp\db\Mysql(
    MYSQL_HOST,
    MYSQL_USERNAME,
    MYSQL_PASSWORD,
    MYSQL_DBNAME);

//exec() executes a result-less query
$db->exec('CREATE TABLE ' . TABLE_WORDS . ' (
    word_id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(32))');

$db->exec(sprintf('INSERT INTO %s (word)
    VALUES("was"), ("jump"), ("hello")',
    TABLE_WORDS));

//escape strings with esc()
$db->exec(sprintf('INSERT INTO %s (word) VALUES("%s")',
    TABLE_WORDS,
    $db->esc('&><\/"')));

//query() returns a 2d array of results
var_dump($db->query('SELECT * FROM ' . TABLE_WORDS));

?>
