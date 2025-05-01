<?php

namespace Src;

use Src\http\Route;

class Application
{
    public Route $route;
    public Database $db;
    public ?Controller $controller = null;

    public function __construct($config)
    {
        $this->route = new Route();
        $this->db = new Database($config["db"]);
    }

    public function run()
    {
        echo json_encode($this->route->resolve());
    }
}
