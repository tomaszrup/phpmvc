<?php

class Database
{

    private static $instance;
    private $connection;

    private function __construct()
    {
        $this->connection = new MySQLi("localhost", "root", "", "phpmvc");
    }

    function __destruct()
    {
        $this->connection->close();
    }

    public static function getConnection()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
}