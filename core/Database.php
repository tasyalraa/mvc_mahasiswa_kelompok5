<?php

require_once __DIR__ . '/../config/database.php';

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            self::$connection = getConnection();
        }

        return self::$connection;
    }
}
