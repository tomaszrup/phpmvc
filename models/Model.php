<?php

require_once __DIR__ . '/../infrastructure/Database.php';

class Model
{

    private static $model;

    public static function instance() {
        if(static::$model == null) {
            static::$model = new static();
        }
        return static::$model;
    }

    public function add(array $data)
    {
        //TODO: Prevent injections
        $data = array_map(function ($item) {
            return '\'' . $item . '\'';
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
        return (object)$this->query($query)->fetch_assoc();
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->table;";
        return array_map(function ($item) {
            return (object)$item;
        }, $this->query($query)->fetch_all(MYSQLI_ASSOC));
    }

    private function query(string $query)
    {
        return Database::getConnection()->query($query);
    }

}