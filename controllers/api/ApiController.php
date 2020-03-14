<?php

require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../../models/Book.php';

class ApiController extends Controller {

    protected function jsonResponse($data) {
        header('Content-type: application/json');
        return json_encode($data);
    }

    public function test() {

        $books = Book::instance()->findAll();

        return $this->jsonResponse([
            "books" => $books
        ]);
    }

}