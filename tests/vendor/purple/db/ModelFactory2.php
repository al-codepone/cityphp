<?php

namespace purple\db;

use cityphp\db\AdapterFactory;
use cityphp\db\Mysql;

class ModelFactory2 extends AdapterFactory {
    public static $isJson;

    protected static function databaseHandle() {
        $errorMessage = self::$isJson
            ? json_encode(array(
                'success' => false,
                'payload' => 'database error'))
 
            : '<html><body>database error</body></html>';

        return new Mysql(
            MYSQL_HOST,
            MYSQL_USERNAME,
            MYSQL_PASSWORD,
            MYSQL_DBNAME,
            null,
            null,
            $errorMessage);
    }
}

?>
