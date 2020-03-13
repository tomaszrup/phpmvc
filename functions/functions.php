<?php

require_once __DIR__ . '/../infrastructure/Settings.php';

function resource($path)
{
    return Settings::$ROUTE_PREFIX . "/resources/" . $path;
}

function path($path)
{
    return Settings::$ROUTE_PREFIX . "/" . $path;
}