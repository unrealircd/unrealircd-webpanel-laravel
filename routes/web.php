<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\{
    BanController,
    ChannelController,
    DashboardController,
    IndexController,
    TestController,
    UserController
};
use Illuminate\Support\Facades\Route;


Route::get('/', IndexController::class)->name('index');

Route::middleware(['auth'])->group(function () {
    // todo: move all routes here that require a login to be accessible.
});

Route::get('/dashboard', DashboardController::class)->name('dashboard'); // middleware: auth

Route::get('/users', [UserController::class, 'index'])->name('users'); // middleware: auth
Route::get('/channels', [ChannelController::class, 'index'])->name('channels'); // middleware: auth

Route::get('/bans', [BanController::class, 'index'])->name('bans'); // middleware: auth
Route::post('/bans', [BanController::class, 'create']); // middleware: auth
Route::put('/bans', [BanController::class, 'store']); // middleware: auth
Route::delete('/bans', [BanController::class, 'destroy']); // middleware: auth

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::get('/test', TestController::class)->name('test');
