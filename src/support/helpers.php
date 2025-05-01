<?php

use Src\Application;

if (!function_exists("base_path")) {
    function base_path()
    {
        return dirname(__DIR__) . "/../";
    }
}

if (!function_exists("app")) {
    function app()
    {
        static $instance = null;
        if (is_null($instance)) {
            require_once base_path() . "config/config.php";
            $instance = new Application($config);
        }
        return $instance;
    }
}
