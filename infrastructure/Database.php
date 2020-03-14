<?php

class Database
{

    private static $instance;
    private $connection;

    private function __construct()
    {
        $this->connection = new PDO('mysql:host=localhost;dbname=phpmvc', "root", "");
    }

    public static function getConnection()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance->connection;
    }

}