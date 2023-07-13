<?php

use App\Http\Controllers\admin\DataPenggunaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('Dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('update-password');
});

    Route::resource('/data-programstudi', DataProgramStudiController::class);
    Route::resource('/data-fakultas', DataFakultasController::class);
    Route::resource('/data-pengguna', DataPenggunaController::class)->except('edit', 'update', 'updatePassword');
    Route::post('/data-pengguna/create', [DataPenggunaController::class, 'create'])->name('create');
    Route::get('/data-pengguna/{user:slug}/edit', [DataPenggunaController::class, 'edit']);
    Route::put('/data-pengguna/{user:slug}', [DataPenggunaController::class, 'update']); 
    Route::put('/data-pengguna/update-password/{user:slug}', [DataPenggunaController::class, 'updatePassword']);



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(AuthMiddleware::class);

