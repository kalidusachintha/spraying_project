<?php

use App\Http\Controllers\Api\SprayingsController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthTokenController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/createtoken', [AuthTokenController::class, 'getToken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/revoke', [AuthTokenController::class, 'revokeToken']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/sprayings', SprayingsController::class);
});
