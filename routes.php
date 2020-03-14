<?php

require_once __DIR__ . '/functions/functions.php';
require_once __DIR__ . '/router/Router.php';

$router = Router::instance();

$router->group("api", function() use ($router) {
    $router->get("/test", "ApiController@test");
});

$router->get("/home", "BookController@home");
$router->get("/creation_form", "BookController@showForm");

$router->post("/books", "BookController@create");