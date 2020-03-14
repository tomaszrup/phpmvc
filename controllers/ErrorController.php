<?php

namespace Controllers;

use Infrastructure\HttpStatus;

class ErrorController extends Controller
{

    public function notFoundPage()
    {
        http_response_code(HttpStatus::$NOT_FOUND);
        return $this->view("404");
    }


}