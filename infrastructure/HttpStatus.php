<?php

namespace Infrastructure;

class HttpStatus {

    public static $OK = 200;
    public static $NO_CONTENT = 204;
    public static $SEE_OTHER = 303;
    public static $NOT_FOUND = 404;
    public static $UNPROCESSABLE_ENTITY = 422;

    private function __construct()
    {
    }
}