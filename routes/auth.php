<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(static function () {
    Route::get('login', [LoginController::class, 'show'])
                ->name('login');

    Route::post('login', [LoginController::class, 'login']);

});

Route::middleware('auth')->group(static function() {
    Route::post('signout', [LoginController::class, 'signout'])->name('signout');
});
