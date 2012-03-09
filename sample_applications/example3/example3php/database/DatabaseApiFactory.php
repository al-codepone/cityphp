<?php

require_once(CITY_PHP . 'database/MySqlDatabaseHandle.php');
require_once(CITY_PHP . 'database/PostgreSqlDatabaseHandle.php');
require_once(EXAMPLE3_PHP . 'database/MySqlDatabaseApi.php');
require_once(EXAMPLE3_PHP . 'database/PostgreSqlDatabaseApi.php');

class DatabaseApiFactory {
    public static function getDatabaseApi() {
        switch(DATABASE_VENDOR) {
            case 'postgresql':
                $databaseHandle = new PostgreSqlDatabaseHandle(PGSQL_DATABASE_CONNECTION_STRING);
                $databaseApi = new PostgreSqlDatabaseApi($databaseHandle);
                break;
            default:
                $databaseHandle = new MySqlDatabaseHandle(MYSQL_DATABASE_HOST,
                    MYSQL_DATABASE_USERNAME,
                    MYSQL_DATABASE_PASSWORD,
                    MYSQL_DATABASE_NAME);
                $databaseApi = new MySqlDatabaseApi($databaseHandle);
        }

        return $databaseApi;
    }
}

?>
