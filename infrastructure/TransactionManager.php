<?php

require_once __DIR__ . '/Database.php';

class TransactionManager
{

    public function transaction(string $query, array $args, bool $returnMultipleRows = false)
    {
        $connection = Database::getConnection()->prepare($query);
        $connection->execute($args);

        if ($returnMultipleRows) {
            return $connection->fetchAll(PDO::FETCH_ASSOC);
        }
        return $connection->fetch(PDO::FETCH_ASSOC);

    }

}