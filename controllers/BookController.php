<?php

require_once 'Controller.php';
require_once __DIR__ . '/../models/Book.php';

class BookController extends Controller {

    public function home() {
        
        $model = new Book;
        $books = $model->findAll();

        return $this->view(
            "home",
            [
                "books" => $books
            ]
        );

    }

}