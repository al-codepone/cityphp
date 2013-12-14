<?php

namespace purple\db;

use cityphp\db\AdapterFactory;
use cityphp\db\Mysql;

class ModelFactory extends AdapterFactory {
    protected static function databaseHandle() {

        //all models share a single instance of this object
        return new Mysql(
            MYSQL_HOST,
            MYSQL_USERNAME,
            MYSQL_PASSWORD,
            MYSQL_DBNAME);
    }
}

?>
