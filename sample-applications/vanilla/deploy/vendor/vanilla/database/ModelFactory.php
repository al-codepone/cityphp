<?php

namespace vanilla\database;

use cityphp\database\AdapterFactory;
use cityphp\database\Mysql;

class ModelFactory extends AdapterFactory {
    protected static function getDatabaseHandle() {
        return new Mysql(
            DATABASE_HOST,
            DATABASE_USERNAME,
            DATABASE_PASSWORD,
            DATABASE_NAME);
    }
}

?>
