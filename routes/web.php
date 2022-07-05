<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\{
    BanController,
    DashboardController,
    IndexController,
    TestController
};
use Illuminate\Support\Facades\Route;


Route::get('/', IndexController::class)->name('index');

Route::middleware(['auth'])->group(function () {
    // todo: move all routes here that require a login to be accessible.
});

Route::get('/dashboard', DashboardController::class)->name('dashboard'); // middleware: auth

Route::put('/ban', [BanController::class, 'store'])->name('ban'); // middleware: auth
Route::delete('/ban', [BanController::class, 'destroy']); // middleware: auth

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::get('/test', TestController::class)->name('test');
