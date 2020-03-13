<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Book.php';

class BookController extends Controller
{

    public function home()
    {
        $books = (new Book)->findAll();

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

    public function create(array $post) {
        // TODO: Validation

        (new Book)->add($post);

    }

}