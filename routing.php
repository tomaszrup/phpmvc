<?php


use Router\Router;

$router = Router::instance();

$router->group("auth", function() use ($router) {
    $router->get("login", "AuthController@showForm");

    $router->post("login", "AuthController@login");
    $router->post("register", "AuthController@register");
    $router->post("logout", "AuthController@logout");
});

$router->get("/home", "BookController@home");
$router->get("/creation_form", "BookController@showForm");

$router->post("/books", "BookController@create");