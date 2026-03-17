<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('events.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/login', function () {
    return view('events.index');
})->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/eventos', function() {
    return view('events.index');
});

Route::get('/cadastro', [RegisteredUserController::class, 'create'])->name('cadastro');
// Route::post('/cadastro', [RegisterController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);
