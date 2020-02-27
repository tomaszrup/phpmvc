<?php

require_once 'Database.php';

class Model {

    public function add($data) {
        array_map($data, function($item) {
            return '`' . $item . '`';
        });

        $values = "(" . implode(",", $data) . ")";

        $query = "INSERT INTO $this->table VALUES $values";
        return $this->query($query);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = $id";
        return $this->query($query);
    }

    public function find($id) {
        $query = "SELECT * FROM $this->table WHERE id = $id";
        return $this->query($query)->fetch_assoc();
    }

    public function findAll() {
        $query = "SELECT * FROM $this->table";
        return $this->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    private function query($query) {
        $result = Database::getConnection()->query($query);
        return $result;
    }

}