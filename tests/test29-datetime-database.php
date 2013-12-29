<?php

require 'const.php';
require 'vendor/autoload.php';
 
$db = new cityphp\db\Mysql(
    MYSQL_HOST,
    MYSQL_USERNAME,
    MYSQL_PASSWORD,
    MYSQL_DBNAME);
 
$db->exec('CREATE TABLE ' . TABLE_EVENTS . ' (
    name VARCHAR(32),
    time DATETIME)');

//use datetimeNow() to store the current time
$db->exec(sprintf('INSERT INTO %1$s (name, time) VALUES
    ("one", "%2$s"),
    ("two", "%2$s" - INTERVAL 2 MINUTE),
    ("three", "%2$s" - INTERVAL 2 DAY)',
    TABLE_EVENTS,
    datetimeNow()));

//use datetimeTo() to convert the stored time
echo implode('<br/>', array_map(
    function($event) {
        return sprintf('%s = %s',
            htmlspecialchars($event['name']),
            datetimeTo($event['time'], 'America/Los_Angeles', 'M j, Y g:ia'));
    },
    $db->query('SELECT * FROM ' . TABLE_EVENTS)));

?>
