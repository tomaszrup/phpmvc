<?php 
require_once 'router.php';

$router = new Router;

$router->get(
    "/home", "BookController@home"
);

$router->request($_SERVER);