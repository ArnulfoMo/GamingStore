<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'cliente.index')->name('inicio');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register/disponibilidad', [AuthController::class, 'checkRegistrationAvailability'])
        ->middleware('throttle:60,1,register-availability:')->name('register.disponibilidad');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1')->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::view('/', 'admin.index')->name('index');
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::patch('/usuarios/{usuario}/rol', [UsuarioController::class, 'updateRole'])->name('usuarios.rol');
    });

    Route::middleware('role:administrador,operador')->prefix('operador')->name('operador.')->group(function () {
        Route::view('/', 'operador.index')->name('index');
    });
});
