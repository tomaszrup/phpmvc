<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Book.php';

class BookController extends Controller
{

    public function home()
    {
        $model = new Book;
        $books = $model->findAll();

        $this->view(
            "home",
            [
                "books" => $books
            ]
        );

    }

    public function showForm() {
        $this->view(
            "create"
        );
    }

}