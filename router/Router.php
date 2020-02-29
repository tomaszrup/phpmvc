<?php

require_once 'Routes.php';
require_once __DIR__ . '/../controllers/BookController.php';

class Router {

private $prefix = "/router";
private $routes;

public function __construct() {
    $this->routes = new Routes;
}

public function get($route, $destination) {
    $this->routes->add("GET", $route, $destination);
}

public function post($route, $destination) {
    $this->routes->add("POST", $route, $destination);
}

public function request($server) {
    $method = $server['REQUEST_METHOD'];
    $route = str_replace($this->prefix, "", $server['REQUEST_URI']);

    $requestData = $this->routes->resolve($method, $route);

    $destinationArray = explode("@", $requestData["destination"]);

    [$controller, $method] = $destinationArray;

    echo (new $controller)->$method(...$requestData["args"]);
}

}