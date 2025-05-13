<?php

use Dotenv\Dotenv;
use Configration\Config;
use Src\Application;
use Src\Seeder;

include_once __DIR__ . "/../src/support/helpers.php";
include_once base_path() . "vendor/autoload.php";
include_once base_path() . "routes/api.php";

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");

$env = Dotenv::createImmutable(base_path());
$env->load();



Application::$app = new Application((new Config())->DB_CONFIG);

// //For Seeding The Database 
// Seeder::seed();

Application::$app->run();
