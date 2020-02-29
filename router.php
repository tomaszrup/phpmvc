<?php

require_once "./controllers/BookController.php";

class Routes {

    private $routes = [
        "GET" => [],
        "POST" => []
    ];

    public function add($method, $route, $destination) {
       $this->routes[$method][$route] = $destination;
    } 

    public function resolve($method, $requestRoute) {
        $savedRoutes = $this->routes[$method];
 
        $savedPaths = array_keys($savedRoutes);
        $requestRouteArray = explode("/", $requestRoute);

        foreach($savedPaths as $path) {
            $pathArray = explode("/", $path);
            
            $matchingSegments = array_intersect($pathArray, $requestRouteArray);

            $pathVariableValues = array_diff($requestRouteArray, $matchingSegments);

            $pathVariableKeys = array_diff($pathArray, $matchingSegments);
            $pathVariableKeys = array_filter($pathVariableKeys, function($item) {
                return preg_match('/{(.*?)}/', $item);
            });

            if(count($pathVariableKeys) == count($pathVariableValues) && 
                count($matchingSegments) + count($pathVariableKeys) == count($pathArray) &&
                count($matchingSegments) > 1) 
            {               
                return [
                    "destination" => $savedRoutes[$path],
                    "args" => $pathVariableValues
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