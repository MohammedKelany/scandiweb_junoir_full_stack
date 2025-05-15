<?php

namespace Src;

class Application
{
    public Database $db;
    public static Application $app;

    public function __construct($config)
    {
        $this->db = new Database($config);
    }
}
