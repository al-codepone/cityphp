<?php

require 'const.php';
require 'vendor/autoload.php';

$db = new cityphp\db\Mysql(
    MYSQL_HOST,
    MYSQL_USERNAME,
    MYSQL_PASSWORD,
    MYSQL_DBNAME);

if($status = mysqli_stat($db->conn())) {
    echo $status;
}
else {
    $db->error();
}

?>
