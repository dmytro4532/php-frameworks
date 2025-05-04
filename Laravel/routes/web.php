<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

//Route::resources([
//    'authors' => AuthorController::class,
//    'books' => BookController::class,
//    'readers' => ReaderController::class,
//    'loans' => LoanController::class,
//    'returns' => ReturnController::class,
//]);
