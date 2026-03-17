<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/eventos', function() {
    return view('events.index');
});

Route::get('/cadastro', [RegisterController::class, 'create'])->name('cadastro');
Route::post('/cadastro', [RegisterController::class, 'store']);
Route::post('/register', [RegisterController::class, 'store']);

//require __DIR__.'/auth.php';