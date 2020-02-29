<?php

require_once __DIR__ . '/router/Router.php';

$router = new Router;

$router->get(
    "/home", "BookController@home"
);