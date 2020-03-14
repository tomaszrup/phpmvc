<?php

require_once __DIR__ . '/functions/functions.php';
require_once __DIR__ . '/router/Router.php';

$router = new Router;

$router->get("/home", "BookController@home");
$router->get("/creation_form", "BookController@showForm");
$router->get("/api/test", "ApiController@test");

$router->post("/books", "BookController@create");