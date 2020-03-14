<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../repositories/BookRepository.php';

class BookController extends Controller
{

    public function home()
    {
        $books = BookRepository::instance()->findAll();

        return $this->view(
            "home",
            [
                "books" => $books
            ]
        );

    }

    public function showForm()
    {
        return $this->view(
            "create"
        );
    }

    public function create(array $post)
    {

        $book = Book::fromArray($post);

        BookRepository::instance()->save($book);

        return $this->redirect("home");
    }

}