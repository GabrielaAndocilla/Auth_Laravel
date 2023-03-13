<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'createStudent'])
                ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'storeStudent']);
    
    Route::get('admin', [AuthenticatedSessionController::class, 'createAdmin'])
                ->name('admin');
    Route::post('admin', [AuthenticatedSessionController::class, 'storeAdmin']);

});

Route::middleware('auth')->group(function () {
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
