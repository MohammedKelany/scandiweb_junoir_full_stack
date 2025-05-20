<?php

if (!function_exists("base_path")) {
    function base_path()
    {
        return dirname(__DIR__) . "/../";
    }
}

if (!function_exists("cors")) {

    // CORS handling function
    function cors()
    {
        // Allow requests from your frontend domain
        $allowedOrigins = [
            'https://scandiweb-test.free.nf',
            'http://localhost:3000', // For local development
            'http://www.hameed.vip', // Production domain
        ];

        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        if (in_array($origin, $allowedOrigins)) {
            header("Access-Control-Allow-Origin: $origin");
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        }


        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Max-Age: 86400'); // 24 hours cache
            exit(0);
        }

        header('Content-Type: application/json');
    }
}
