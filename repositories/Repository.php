<?php

require_once __DIR__ . '/../models/Model.php';
require_once __DIR__ . '/../infrastructure/Database.php';

abstract class Repository {

    private static $instance;

    private function __construct()
    {
    }

    public static function instance() : self {
        if(!static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    /**
     * @throws ReflectionException
     */
    public function save(Model $entity)
    {
        //TODO: Prevent injections

        $data = array_filter($entity->toArray());
        $data = array_map(function($item) {
            return "'$item'";
        }, $data);

        $values = implode(",", $data);
        $columns = implode(",", array_keys($data));

        $query = "INSERT INTO $this->table ($columns) VALUES ($values);";

        return $this->query($query);
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM $this->table WHERE id = $id;";
        return $this->query($query);
    }

    public function find(int $id)
    {
        $query = "SELECT * FROM $this->table WHERE id = $id;";
        $result = $this->query($query)->fetch_assoc();
        return $this->arrayToObject($result);
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->table;";
        $results = $this->query($query)->fetch_all(MYSQLI_ASSOC);
        return array_map([$this, 'arrayToObject'], $results);
    }

    public function query(string $query)
    {
        return Database::getConnection()->query($query);
    }

    abstract public function arrayToObject(array $array);

}