<?php

use App\Http\Controllers\{
    BanController,
    ChannelController,
    DashboardController,
    IndexController,
    SpamfilterController,
    UserController,
    LanguageController};
use Illuminate\Support\Facades\Route;


Route::get('/', IndexController::class)->name('index');

Route::get('/lang/{lang}', LanguageController::class)->name('lang');

Route::middleware(['auth'])->group(static function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/channels', [ChannelController::class, 'index'])->name('channels');

    Route::get('/bans', [BanController::class, 'index'])->name('bans.index');
    Route::post('/bans', [BanController::class, 'store'])->name('bans.store');
    Route::put('/bans', [BanController::class, 'update'])->name('bans.update');
    Route::delete('/bans', [BanController::class, 'destroy'])->name('bans.destroy');

    Route::get('/spamfilter', [SpamfilterController::class, 'index'])->name('spamfilter.index');
    Route::post('/spamfilter', [SpamfilterController::class, 'store'])->name('spamfilter.store');
    Route::put('/spamfilter', [SpamfilterController::class, 'update'])->name('spamfilter.update');
    Route::delete('/spamfilter', [SpamfilterController::class, 'destroy'])->name('spamfilter.destroy');
});

require_once __DIR__ . '/auth.php';
