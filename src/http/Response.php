<?php

namespace Src\http;

class Response
{
    public function setStatueCode(int $code)
    {
        http_response_code($code);
    }
    public static function redirect($location)
    {
        return header("Location: $location");
    }
}
