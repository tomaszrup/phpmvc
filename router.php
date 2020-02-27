<?php

require_once "./controllers/HomeController.php";

class Routes {

    private $routes = [
        "GET" => [],
        "POST" => []
    ];

    public function add($method, $route, $destination) {
       $this->routes[$method][$route] = $destination;
    } 

    public function resolve($method, $route) {
        $routes = $this->routes[$method];
 
        $paths = array_keys($routes);
        $routeArray = explode("/", $route);

        foreach($paths as $path) {

            $pathArray = explode("/", $path);
            
            $intersect = array_intersect($pathArray, $routeArray);

            $argValues = array_diff($routeArray, $intersect);
            $argKeys = array_diff($pathArray, $intersect);
            $argKeys = array_filter($argKeys, function($item) {
                return preg_match('/{(.*?)}/', $item);
            });

            if(count($argKeys) == count($argValues) 
            && count($intersect) + count($argKeys) == count($pathArray) 
            && count($intersect) > 1) {       
                
                return [
                    "destination" => $routes[$path],
                    "args" => $argValues
                ];
            }
        }

        throw new Exception("No such route");

    }

}

class Router {

    private $prefix = "/router";
    private $routes;

    public function __construct() {
        $this->routes = new Routes;
    }

    public function get($route, $destination) {
        $this->routes->add("GET", $route, $destination);
    }

    public function request($server) {
        $method = $server['REQUEST_METHOD'];
        $route = str_replace($this->prefix, "", $server['REQUEST_URI']);

        $requestData = $this->routes->resolve($method, $route);
    
        $destinationArray = explode("@", $requestData["destination"]);

        $controller = $destinationArray[0];
        $method = $destinationArray[1];

        (new $controller)->$method(...$requestData["args"]);
    }

}