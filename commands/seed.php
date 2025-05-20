<?php

use Dotenv\Dotenv;
use Configration\Config;
use Src\Application;
use Src\Seeder;

require_once __DIR__ . "/../src/support/helpers.php";
require_once base_path() . "vendor/autoload.php";

$env = Dotenv::createImmutable(base_path());
$env->load();

Application::$app = new Application((new Config())->DB_CONFIG);

Seeder::seed();
