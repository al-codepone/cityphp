<?php

require_once(CITY_PHP . 'database/MySqlDatabaseHandle.php');
require_once(GUEST_BOOK_PHP . 'database/MySqlGuestBookDatabaseApi.php');

class GuestBookDatabaseApiFactory {
    public static function getDatabaseApi() {
        $databaseHandle = new MySqlDatabaseHandle(MYSQL_DATABASE_HOST,
            MYSQL_DATABASE_USERNAME,
            MYSQL_DATABASE_PASSWORD,
            MYSQL_DATABASE_NAME);
        return new MySqlGuestBookDatabaseApi($databaseHandle);
    }
}

?>
