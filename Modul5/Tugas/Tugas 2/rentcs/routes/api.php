<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/gamelist', App\Http\Controllers\Api\gamelistsController::class);
Route::apiResource('/products', App\Http\Controllers\Api\productsController::class);