<?php 
require_once './router.php';

$router = new Router;

$router->get(
    "/home", "HomeController@index"
);

$router->get(
    "/test/{id}", "HomeController@test"
);


$router->request($_SERVER);