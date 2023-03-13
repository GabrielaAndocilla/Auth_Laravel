<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'can:admin_user'])->group(function () {
    Route::get('/usuarios', [UserController::class,'show'])->name('show_users');
    Route::get('/nuevo/usuario', [UserController::class,'create'])->name('create_user');
    Route::post('/nuevo/usuario', [UserController::class, 'store']);
    Route::get('/editar/usuario/{id}', [UserController::class,'edit'])->name('edit_user');
    Route::patch('/editar/usuario/{id?}', [UserController::class, 'update'])->name('update_user');
    Route::delete('/eliminar/usuario/{id?}', [UserController::class, 'destroy'])->name('delete_user');;


});

Route::middleware('auth')->group(function () {
    Route::get('/inicio', [UserController::class,'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
