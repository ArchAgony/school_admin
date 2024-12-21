<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\UserController;
use App\Models\StudentClass;
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

Route::prefix('/school')->group(function(){
    Route::get('', [SchoolController::class, 'index']);
    Route::get('/{id}', [SchoolController::class, 'show']);
    Route::post('', [SchoolController::class, 'create']);
    Route::put('/{id}', [SchoolController::class, 'update']);
    Route::delete('/{id}', [SchoolController::class, 'destroy']);
});

Route::prefix('/student-class')->group(function(){
    Route::get('', [StudentClassController::class, 'index']);
    Route::get('/{id}', [StudentClassController::class, 'show']);
    Route::post('', [StudentClassController::class, 'create']);
    Route::put('/{id}', [StudentClassController::class, 'update']);
    Route::delete('/{id}', [StudentClassController::class, 'destroy']);
});

