<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Book.php';

class ErrorController extends Controller
{

    public function notFoundPage()
    {
        http_response_code(404);
        $this->view("404");
    }


}