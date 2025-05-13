<?php

use App\controllers\GraphqlController;
use Src\http\Route;


Route::get("/graphql", [GraphqlController::class, "handle"]);
Route::post("/graphql", [GraphqlController::class, "handle"]);
