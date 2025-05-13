<?php

namespace Src\http;

use Src\Application;

class Route
{

    public static array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
    }

    public static function get($path, $action)
    {
        self::$routes["get"][$path] = $action;
    }

    public static function post($path, $action)
    {
        self::$routes["post"][$path] = $action;
    }


    public function resolve($args = [])
    {
        $path = $this->request->path();
        $method = $this->request->method();
        $action = self::$routes[$method][$path] ?? false;
        if ($action == false) {
            return [
                "error" => "This is not valid Route"
            ];
        } else if (is_array($action)) {
            $controller = new $action[0];
            $action = $action[1];
            return call_user_func_array([$controller, $action], $args);
        }
    }
}
