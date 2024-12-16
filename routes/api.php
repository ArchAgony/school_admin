<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/auth')->group(function(){
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('/city')->group(function(){
    Route::get('', [CityController::class, 'index']);
    Route::get('/{id}', [CityController::class, 'show']);
    Route::post('', [CityController::class, 'create']);
    Route::put('/{id}', [CityController::class, 'update']);
    Route::delete('/{id}', [CityController::class, 'destroy']);
});
