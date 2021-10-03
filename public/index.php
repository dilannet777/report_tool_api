<?php
require "../bootstrap.php";

use Src\Controllers\ReportController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header("HTTP/1.1 200 OK");
    die();
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// all of our endpoints start with /api
// everything else results in a 404 Not Found

if (empty($uri[1]) || $uri[1] !== 'api') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

if (empty($uri[2]) || $uri[2] !== 'reports') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

if (empty($uri[3]) || $uri[3] !== 'turnover') {
    header("HTTP/1.1 404 Not Found");
    exit();
}


$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($uri[2]) {
    case 'reports': {

            $controller = new ReportController($dbConnection, $requestMethod, $uri[3]);
            if ($uri[3] == 'turnover') {
                $controller->processRequest();
            }
        };
        break;
    default: {
            header("HTTP/1.1 404 Not Found");
            exit();
        }
}
