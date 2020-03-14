<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Book.php';

class BookController extends Controller
{

    public function home()
    {
        $books = Book::instance()->findAll();

        return $this->view(
            "home",
            [
                "books" => $books
            ]
        );

    }

    public function showForm() {
        return $this->view(
            "create"
        );
    }

    public function create(array $post) {
        // TODO: Validation

        Book::instance()->add($post);

        return redirect("home");
    }

}