<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../infrastructure/HttpStatus.php';

class ErrorController extends Controller
{

    public function notFoundPage()
    {
        http_response_code(HttpStatus::$NOT_FOUND);
        return $this->view("404");
    }


}