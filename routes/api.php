<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CategoryJurnalFoodController;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/register', RegisterController::class);
        Route::post('/login', LoginController::class);
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('/foods', FoodController::class);
        Route::apiResource('/activities', ActivityController::class);
        Route::apiResource('/categoryfoods', CategoryJurnalFoodController::class);
    });
});
