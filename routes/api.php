<?php

use App\controllers\ProductController;
use Src\http\Route;

Route::get("/api/products", [ProductController::class, "index"]);
Route::get("/", [ProductController::class, "index"]);
