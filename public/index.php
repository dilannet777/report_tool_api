<?php
require "../bootstrap.php";

use Src\Controllers\TurnoverReportController;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;



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

$router = new RouteCollector();


$router->any('/', function () {
    return 'REPORT APIS V.1.0.0';
});

$router->post('api/reports/turnover', function () {
    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
    $invokeReportTurnover = new turnoverReportController();
    return $invokeReportTurnover($input);
});



# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Dispatcher($router->getData());

try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    // Print out the value returned from the dispatched function
    header($response['status_code_header']);
    if ($response['body']) {
        echo json_encode($response['body']);
    }
} catch (Exception $e) {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}
