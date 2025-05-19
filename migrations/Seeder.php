<?php

namespace Migration;

use Src\Application;
use Src\Database;

abstract class Seeder
{
    protected Database $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }

    abstract public function run(): void;
}
