<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route untuk publik yang tidak memerlukan login.
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| Semua route di dalam grup ini WAJIB PENGGUNA UNTUK LOGIN
| dan (jika ada) emailnya sudah terverifikasi.
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Profile Routes (dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Board Routes
    Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');
    Route::post('/boards', [BoardController::class, 'store'])->name('boards.store');
    Route::get('/boards/{board}', [BoardController::class, 'show'])->name('boards.show');

    // Memory & Comment Routes
    Route::post('/boards/{board}/memories', [MemoryController::class, 'store'])->name('memories.store');
    Route::post('/boards/{board}/comments', [CommentController::class, 'store'])->name('comments.store');

    // User Profile Route
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// File ini berisi route otentikasi (login, register, dll) dari Laravel Breeze
require __DIR__.'/auth.php';