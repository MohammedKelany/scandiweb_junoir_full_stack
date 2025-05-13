<?php

namespace Src;

use Src\http\Request;

abstract class Controller
{
    abstract function handle();
}
