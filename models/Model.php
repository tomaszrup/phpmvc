<?php

namespace Models;

use Infrastructure\Annotations;

abstract class Model implements \JsonSerializable
{

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
        $array = get_object_vars($this);

        foreach ($array as $key => $value) {
            if (propertyHasAnnotation($this, $key, Annotations::$JSON_IGNORE)) {
                unset($array[$key]);
            }
        }

        return $array;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public static function fromArray(array $array)
    {
        $model = new static();
        foreach ($array as $key => $value) {
            if (property_exists($model, $key)) {
                $model->$key = $value;
            }
        }
        return $model;
    }

}