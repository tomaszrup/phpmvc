<?php

require_once __DIR__ . '/BookRepository.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/Repository.php';

class BookRepository extends Repository {

    protected $table = "books";

    public function arrayToObject(array $array)
    {
        return Book::fromArray($array);
    }
}