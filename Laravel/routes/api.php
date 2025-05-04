<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\ReturnController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
});

// Only Admin can DELETE
Route::middleware(['auth:api', 'role:Admin'])->group(function () {
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::delete('/readers/{id}', [ReaderController::class, 'destroy'])->name('readers.destroy');
    Route::delete('/loans/{id}', [LoanController::class, 'destroy'])->name('loans.destroy');
    Route::delete('/returns/{id}', [ReturnController::class, 'destroy'])->name('returns.destroy');
});

// Manager, Admin can CREATE and UPDATE
Route::middleware(['auth:api', 'role:Manager,Admin'])->group(function () {
    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::put('/authors/{id}', [AuthorController::class, 'update'])->name('authors.update');

    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');

    Route::post('/readers', [ReaderController::class, 'store'])->name('readers.store');
    Route::put('/readers/{id}', [ReaderController::class, 'update'])->name('readers.update');

    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
    Route::put('/loans/{id}', [LoanController::class, 'update'])->name('loans.update');

    Route::post('/returns', [ReturnController::class, 'store'])->name('returns.store');
    Route::put('/returns/{id}', [ReturnController::class, 'update'])->name('returns.update');
});

// All roles (Client, Manager, Admin) can READ
Route::middleware(['auth:api', 'role:Client,Manager,Admin'])->group(function () {
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

    Route::get('/readers', [ReaderController::class, 'index'])->name('readers.index');
    Route::get('/readers/{id}', [ReaderController::class, 'show'])->name('readers.show');

    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/{id}', [LoanController::class, 'show'])->name('loans.show');

    Route::get('/returns', [ReturnController::class, 'index'])->name('returns.index');
    Route::get('/returns/{id}', [ReturnController::class, 'show'])->name('returns.show');
});
