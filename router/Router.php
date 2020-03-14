<?php

require_once __DIR__ . '/Routes.php';
require_once __DIR__ . '/../controllers/BookController.php';
require_once __DIR__ . '/../controllers/ErrorController.php';
require_once __DIR__ . '/../controllers/api/ApiController.php';

require_once __DIR__ . '/../infrastructure/Settings.php';

class Router
{

    private static $instance;
    private $routes;
    private $currentGroup;

    private function __construct()
    {
        $this->routes = new Routes;
    }

    public static function instance() {
        if(!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function group(string $groupPrefix, Closure $callback) {
        $this->currentGroup = $groupPrefix;
        $callback();
        $this->currentGroup = null;
    }

    public function get(string $route, string $destination)
    {
        $this->routes->add("GET", $route, $destination, $this->currentGroup);
    }

    public function post(string $route, string $destination)
    {
        $this->routes->add("POST", $route, $destination, $this->currentGroup);
    }

    public function request(array $server)
    {
        $httpMethod = $server['REQUEST_METHOD'];
        $route = str_replace(Settings::$ROUTE_PREFIX, "", $server['REQUEST_URI']);

        try {
            $requestData = $this->routes->resolve($httpMethod, $route);
        } catch (Exception $exception) {
            (new ErrorController)->notFoundPage();
            return false;
        }

        $destinationArray = explode("@", $requestData["destination"]);

        [$controller, $method] = $destinationArray;

        if ($httpMethod == "GET") {
            $attributes = $_GET;
        } else {
            $attributes = $_POST;
        }

        array_push($requestData["args"], $attributes);

        return (new $controller)->$method(...$requestData["args"]);
    }

}