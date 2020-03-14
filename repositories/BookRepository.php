<?php

namespace Repositories;

use Models\Book;

class BookRepository extends Repository {

    protected $table = "books";
    protected $class = Book::class;

}