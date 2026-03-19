<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\EventosController;
use Illuminate\Support\Facades\Auth;
use App\Models\Evento;
use App\Models\Registro;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $eventos = Evento::with('usuario')->latest()->get();
    $registros = Auth::check()
    ? Registro::where('user_id', Auth::id())->pluck('evento_id')->toArray()
    : [];

    return view('welcome', compact('eventos', 'registros'));
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('events', EventosController::class)->middleware('auth');
Route::get('/dashboard', [EventosController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('/events/{id}/confirm', [EventosController::class, 'confirmarPresenca'])->middleware('auth');

require __DIR__ . '/auth.php';
