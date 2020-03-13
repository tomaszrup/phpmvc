<?php

require_once __DIR__ . '/../infrastructure/Database.php';

class Model
{

    public function add($data)
    {
        array_map(function ($item) {
            return '`' . $item . '`';
        }, $data);

        $values = "(" . implode(",", $data) . ")";

        $query = "INSERT INTO $this->table VALUES $values";
        return $this->query($query);
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = $id";
        return $this->query($query);
    }

    public function find($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = $id";
        return (object) $this->query($query)->fetch_assoc();
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->table";
        return array_map(function ($item) {
            return (object) $item;
        }, $this->query($query)->fetch_all(MYSQLI_ASSOC));
    }

    private function query($query)
    {
        return Database::getConnection()->query($query);
    }

}