<?php 


namespace AutoCaelum\Data;

class Db
{
    private static $instance = null;
    private function __construct() {}

    public static function getConnection(string $host, string $user, string $pwd, string $dbname, ?int $port = null)
    {
        if (self::$instance == null) 
        {
            self::$instance = "conexão " . rand(1, 10);
        }

        return self::$instance;
    }
}
