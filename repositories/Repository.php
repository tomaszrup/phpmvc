<?php

require_once __DIR__ . '/../models/Model.php';
require_once __DIR__ . '/../infrastructure/Database.php';

abstract class Repository {

    private static $instance;

    private final function __construct()
    {
        if(!isset($this->table) || !isset($this->class)) {
            throw new LogicException(get_class($this) . "must have a \$table and \$class properties");
        }
    }

    public static function instance() : self {
        if(!static::$instance) {
            static::$instance = new static();
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
        $result = $this->query($query)->fetch(PDO::FETCH_ASSOC);
        return $this->arrayToRepositoryClassObject($result);
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->table;";
        $results = $this->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return array_map([$this, 'arrayToRepositoryClassObject'], $results);
    }

    public function query(string $query)
    {
        return Database::getConnection()->query($query);
    }


    private function arrayToRepositoryClassObject(array $array)
    {
        if(method_exists($this->class, 'fromArray')) {
            return $this->class::fromArray($array);
        }
        throw new LogicException("Repository class property must implement a fromArray static method");
    }

}