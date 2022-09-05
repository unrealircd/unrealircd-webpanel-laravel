<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\{
    BanController,
    ChannelController,
    DashboardController,
    IndexController,
    TestController,
    UserController,
    LanguageController
};
use Illuminate\Support\Facades\Route;


Route::get('/', IndexController::class)->name('index');

Route::get('/lang/{lang}', LanguageController::class)->name('lang');

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

Route::get('/test', TestController::class)->name('test');

require_once __DIR__ . '/auth.php';
