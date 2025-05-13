<?php

if (!function_exists("base_path")) {
    function base_path()
    {
        return dirname(__DIR__) . "/../";
    }
}
