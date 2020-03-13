<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Book.php';

class ErrorController extends Controller
{

    public function notFoundPage()
    {
        $this->view("404");
    }


}