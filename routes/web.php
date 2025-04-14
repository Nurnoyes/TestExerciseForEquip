<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/book/{id}', [\App\Http\Controllers\BookController::class, 'show']);
