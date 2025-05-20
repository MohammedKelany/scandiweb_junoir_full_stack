<?php

use Dotenv\Dotenv;
use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use App\Controller\GraphqlController;

include_once __DIR__ . "/../src/support/helpers.php";
include_once base_path() . "vendor/autoload.php";

cors();

// Load .env variables
$env = Dotenv::createImmutable(base_path());
$env->load();

// Define routes
$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->post('/graphql', [GraphqlController::class, 'handle']);
});

// Dispatch the route
$routeInfo = $dispatcher->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        require(base_path() . 'public/index.html');
        break;

    case Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        http_response_code(405);
        echo json_encode([
            "error" => "405 Method Not Allowed",
            "message" => "The route you're trying to access is not allowed with this method!"
        ]);
        break;

    case Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        echo $handler($vars);
        break;
}
