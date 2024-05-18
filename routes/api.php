<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/register', RegisterController::class);
        Route::post('/login', LoginController::class);
    });

    Route::get('/foods', [FoodController::class, 'index'])
        ->name('foods.index');
    Route::get('/foods/{id}', [FoodController::class, 'show'])
        ->name('foods.show');
    Route::post('/foods', [FoodController::class, 'store'])
        ->name('foods.store');
    Route::put('/foods/{id}', [FoodController::class, 'update'])
        ->name('foods.update');
    Route::delete('/foods/{id}', [FoodController::class, 'destroy'])
        ->name('foods.destroy');
});
