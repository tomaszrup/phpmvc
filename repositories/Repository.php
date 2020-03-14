<?php

namespace Repositories;

use Models\Model;
use Infrastructure\TransactionManager;

abstract class Repository
{

    private static $instance;
    private $transactionManager;

    private final function __construct(TransactionManager $transactionManager)
    {
        if (!isset($this->table) || !isset($this->class)) {
            throw new \LogicException(get_class($this) . "must have a \$table and \$class properties");
        }

        $this->transactionManager = $transactionManager;
    }

    public static function instance(): self
    {
        if (!static::$instance) {
            static::$instance = new static(new TransactionManager());
        }
        return static::$instance;
    }

    public function save(Model $entity)
    {
        $entityProperties = array_filter($entity->toArray());

        $columns = implode(",", array_keys($entityProperties));

        $valuesPlaceholder = array_map(function ($item) {
            return ":$item";
        }, array_keys($entityProperties));
        $valuesPlaceholder = implode(",", $valuesPlaceholder);

        return $this->transactionManager->transaction(
            "INSERT INTO $this->table ($columns) VALUES ($valuesPlaceholder)",
            $entityProperties
        );

    }

    public function delete(int $id)
    {
        return $this->transactionManager->transaction(
            "DELETE FROM $this->table WHERE id = :id;",
            [
                "id" => $id
            ]
        );

    }

    public function find(int $id)
    {

        $result = $this->transactionManager->transaction(
            "SELECT * FROM $this->table WHERE id = :id;",
            [
                "id" => $id
            ]
        );
        return $this->arrayToRepositoryClassObject($result);
    }

    public function findAll()
    {
        $results = $this->transactionManager->transaction(
            "SELECT * FROM $this->table;",
            [],
            true
        );
        return array_map([$this, 'arrayToRepositoryClassObject'], $results);
    }

    private function arrayToRepositoryClassObject(array $array)
    {
        if (method_exists($this->class, 'fromArray')) {
            return $this->class::fromArray($array);
        }
        throw new \LogicException("Repository class property must implement a fromArray static method");
    }

}