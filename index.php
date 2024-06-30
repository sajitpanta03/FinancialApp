<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

const BASE_PATH = __DIR__ . '/';

require 'core/helpers.php';
require 'core/Router.php';


spl_autoload_register(function ($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $path = basePath("{$class}.php");

    if (file_exists($path)) {
        require $path;
    } else {
        die('Error: File not found for class ' . $class . ' at ' . $path);
    }
});

$router = core\Router::getRouter();
require BASE_PATH . "routes/web.php";

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// echo "Routing {$method} request for {$uri}<br>\n";

$router->route($method, $uri);

exit();
