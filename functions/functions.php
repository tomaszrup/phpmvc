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
