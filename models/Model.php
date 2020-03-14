<?php

namespace Models;

abstract class Model implements \JsonSerializable {

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
       $this->$name = $value;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function toArray() {
        return get_object_vars($this);
    }

    public static function fromArray(array $array) {
        $model = new static();
        foreach ($array as $key => $value) {
            $model->$key = $value;
        }
        return $model;
    }

}