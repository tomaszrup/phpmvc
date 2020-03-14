<?php


use Router\Router;

$router = Router::instance();

$router->get("/home", "BookController@home");
$router->get("/creation_form", "BookController@showForm");

$router->post("/books", "BookController@create");