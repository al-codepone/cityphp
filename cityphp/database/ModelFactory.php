<?php

abstract class ModelFactory {
    public static $format;
    private static $databaseHandle;

    public static function getModel($modelName) {
        if(!self::$databaseHandle) {
            self::$databaseHandle = static::getDatabaseHandle();
        }

        return new $modelName(self::$databaseHandle);
    }

    abstract protected static function getDatabaseHandle();
}

?>
