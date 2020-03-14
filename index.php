<?php

require __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . '/functions/functions.php';
require_once __DIR__ . '/routing.php';

$router->request($_SERVER);