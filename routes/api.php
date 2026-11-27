<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1,api-login:');

Route::middleware(['auth:sanctum', 'activo'])->name('api.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
