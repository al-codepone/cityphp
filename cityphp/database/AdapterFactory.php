<?php

namespace cityphp\database;

abstract class AdapterFactory {
    public static $format;
    private static $databaseHandle;

    public static function get($adapterName) {
        if(!self::$databaseHandle) {
            self::$databaseHandle = static::getDatabaseHandle();
        }

        return new $adapterName(self::$databaseHandle);
    }

    abstract protected static function getDatabaseHandle();
}

?>
