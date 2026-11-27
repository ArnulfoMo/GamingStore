<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\PerfilController;
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
    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::patch('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
    Route::resource('direcciones', DireccionController::class)->parameters(['direcciones' => 'direccion']);
    Route::patch('/direcciones/{direccion}/principal', [DireccionController::class, 'principal'])->name('direcciones.principal');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::view('/', 'admin.index')->name('index');
        Route::resource('usuarios', UsuarioController::class)
            ->only(['index', 'update'])
            ->parameters(['usuarios' => 'usuario']);
        Route::patch('/usuarios/{usuario}/estado', [UsuarioController::class, 'updateStatus'])->name('usuarios.estado');
    });

    Route::middleware('role:administrador,operador')->prefix('operador')->name('operador.')->group(function () {
        Route::view('/', 'operador.index')->name('index');
    });
});
