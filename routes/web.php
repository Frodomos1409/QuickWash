<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\Personal\ReservationController as PersonalReservationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:estudiante'])->group(function () {
    Route::get('/maquinas', [MachineController::class, 'index'])->name('machines.index');

    Route::get('/reservas', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservas/crear', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservas', [ReservationController::class, 'store'])->name('reservations.store');
    Route::patch('/reservas/{reservation}/cancelar', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});

Route::middleware(['auth', 'role:personal'])->prefix('personal')->name('personal.')->group(function () {
    Route::get('/reservas', [PersonalReservationController::class, 'index'])->name('reservations.index');
    Route::patch('/reservas/{reservation}/estado', [PersonalReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
});

require __DIR__.'/auth.php';
