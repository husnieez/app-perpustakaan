<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Route untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Route yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    Route::resource('loans', LoanController::class);
    Route::put('loans/{id}/kembalikan', [LoanController::class, 'kembalikan'])
        ->name('loans.kembalikan');

    // Hanya admin yang bisa mengakses kategori
    Route::resource('categories', CategoryController::class)
        ->except(['show'])
        ->middleware('admin');

    // Halaman profil dan ganti password
    Route::get('/profil', [ProfileController::class, 'show'])->name('profil');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profil.password');
});
