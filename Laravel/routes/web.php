<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);

Route::prefix('products')->group(function () {

    Route::get('/', [ProductController::class, 'getProducts']);

    Route::get('/{id}', [ProductController::class, 'getProductItem']);

    Route::post('/', [ProductController::class, 'createProduct']);

    Route::put('/{id}', [ProductController::class, 'updateProduct']);

    Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
});
