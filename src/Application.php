<?php

namespace Src;

use Src\http\Route;

class Application
{
    public Route $route;
    public Database $db;
    public static Application $app;

    public function __construct($config)
    {
        $this->route = new Route();
        $this->db = new Database($config);
    }

    public function run()
    {
        echo json_encode($this->route->resolve());
    }
}
