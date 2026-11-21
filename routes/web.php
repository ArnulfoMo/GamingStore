<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'cliente.index')->name('inicio');
Route::view('/admin', 'admin.index')->name('admin.index');
