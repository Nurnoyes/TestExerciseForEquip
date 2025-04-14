<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/books', [App\Http\Controllers\Api\BookController::class, 'index']);
Route::get('/books/{id}', [App\Http\Controllers\Api\BookController::class, 'show']);
Route::delete('/books/{id}', [App\Http\Controllers\Api\BookController::class, 'destroy']);
Route::post('/books', [App\Http\Controllers\Api\BookController::class, 'store']);
Route::patch('/books/{id}', [App\Http\Controllers\Api\BookController::class, 'update']);
Route::get('/groups', [App\Http\Controllers\Api\ShopController::class, 'index']);
Route::get('/groups/group_id/{id}', [App\Http\Controllers\Api\ShopController::class, 'show']);
Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);
Route::get('/products/parent_id/{id}', [App\Http\Controllers\Api\ProductController::class, 'show']);
Route::get('/products/parent_id/{id}/sortBy={sorting}/orderBy={ordering}', [App\Http\Controllers\Api\ProductController::class, 'sorting']);
Route::get('/product_id/{id}', [App\Http\Controllers\Api\SingleProductController::class, 'show']);






