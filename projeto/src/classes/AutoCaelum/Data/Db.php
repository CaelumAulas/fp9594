<?php 


namespace AutoCaelum\Data;

final class Db
{
    private static ?IDatabase $instance = null;
    private function __construct() {}

    public static function getConnection(string $host, string $user, string $pwd, string $dbname, ?int $port = null) : IDatabase
    {
        if (self::$instance == null) 
        {
            self::$instance = new MySqlDb($host, $user, $pwd, $dbname, $port);
        }

        return self::$instance;
    }
}
