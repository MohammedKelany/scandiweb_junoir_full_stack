<?php

use Dotenv\Dotenv;

include_once __DIR__ . "/../src/support/helpers.php";
include_once base_path() . "vendor/autoload.php";
include_once base_path() . "routes/api.php";
header("Access-Control-Allow-Origin:*");

$env = Dotenv::createImmutable(base_path());
$env->load();


app()->run();
