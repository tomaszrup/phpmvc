<?php

use Infrastructure\Settings;

function resource(string $path)
{
    return Settings::$ROUTE_PREFIX . "/resources/" . $path;
}

function path(string $path)
{
    return Settings::$ROUTE_PREFIX . "/" . $path;
}
