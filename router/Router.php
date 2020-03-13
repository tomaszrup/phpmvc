<?php

require_once __DIR__ . '/Routes.php';
require_once __DIR__ . '/../controllers/BookController.php';
require_once __DIR__ . '/../controllers/ErrorController.php';
require_once __DIR__ . '/../infrastructure/Settings.php';

class Router
{

    private $routes;

    public function __construct()
    {
        $this->routes = new Routes;
    }

    public function get(string $route, $destination)
    {
        $this->routes->add("GET", $route, $destination);
    }

    public function post($route, $destination)
    {
        $this->routes->add("POST", $route, $destination);
    }

    public function request($server)
    {
        $method = $server['REQUEST_METHOD'];
        $route = str_replace(Settings::$ROUTE_PREFIX, "", $server['REQUEST_URI']);

        try {
            $requestData = $this->routes->resolve($method, $route);
        } catch (Exception $exception) {
            (new ErrorController)->notFoundPage();
            return false;
        }

        $destinationArray = explode("@", $requestData["destination"]);

        [$controller, $method] = $destinationArray;

        echo (new $controller)->$method(...$requestData["args"]);
    }

}