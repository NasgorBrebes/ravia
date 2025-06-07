<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/update/event', [EventController::class, 'update'])->name('event.update');
    Route::post('/guest', [GuestController::class, 'store'])->name('guest.store');
    Route::patch('/guest/{guest}', [GuestController::class, 'update'])->name('guest.update');
    Route::delete('/guest', [GuestController::class, 'destroy'])->name('guest.destroy');
    Route::patch('/dashboard', [WebController::class, 'index'])->name('dashboard.index');
});

require __DIR__.'/auth.php';
