<?php

namespace Configration;

class Config
{
    public array $DB_CONFIG;

    public function __construct()
    {
        $this->DB_CONFIG = [
            "dsn" => $_ENV["DB_DSN"],
            "username" => $_ENV["DB_USER"],
            "password" => $_ENV["DB_PASSWORD"],
        ];
    }
}
