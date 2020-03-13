<?php

class Routes
{

    private $routes = [
        "GET" => [],
        "POST" => [],
        "PUT" => [],
        "PATCH" => [],
        "DELETE" => []
    ];

    public function add($method, $route, $destination)
    {
        $this->routes[$method][$route] = $destination;
    }

    /**
     * @throws Exception
     */
    public function resolve($method, $requestRoute)
    {
        $savedRoutes = $this->routes[$method];

        $savedPaths = array_keys($savedRoutes);
        $requestRouteArray = explode("/", $requestRoute);

        foreach ($savedPaths as $path) {
            $pathArray = explode("/", $path);

            $matchingSegments = array_intersect($pathArray, $requestRouteArray);

            $pathVariableValues = array_diff($requestRouteArray, $matchingSegments);

            $pathVariableKeys = array_diff($pathArray, $matchingSegments);
            $pathVariableKeys = array_filter($pathVariableKeys, function ($item) {
                return preg_match('/{(.*?)}/', $item);
            });

            if (count($pathVariableKeys) == count($pathVariableValues) &&
                count($matchingSegments) + count($pathVariableKeys) == count($pathArray) &&
                count($matchingSegments) > 1) {
                return [
                    "destination" => $savedRoutes[$path],
                    "args" => $pathVariableValues
                ];
            }
        }

        throw new Exception();
    }

}