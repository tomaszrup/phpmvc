<?php

require_once __DIR__ . '/../infrastructure/Settings.php';

function resource(string $path)
{
    return Settings::$ROUTE_PREFIX . "/resources/" . $path;
}

function path(string $path)
{
    return Settings::$ROUTE_PREFIX . "/" . $path;
}

function redirect(string $url, int $statusCode = 303)
{
    header('Location: ' . path($url), true, $statusCode);
    die();
}