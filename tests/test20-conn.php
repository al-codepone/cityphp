<?php

require_once 'const.php';
require_once CITYPHP . '__autoload.php';

use cityphp\db\Mysql;

$db = new Mysql(
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
