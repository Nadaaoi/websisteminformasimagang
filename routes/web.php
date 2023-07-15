<?php

use App\Http\Controllers\admin\DataPenggunaController;
use App\Http\Controllers\admin\DataProgramStudiController;
use App\Http\Controllers\admin\DataFakultasController;
use App\Http\Controllers\user\pemaganganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthMiddleware;
use App\Models\Pemagangan;

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

// Route::get('/dashboard', function () {
//     return view('Dashboard');
// });


Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('update-password');
});

    Route::resource('/data-DataProgramStudi', DataProgramStudiController::class);
    Route::resource('/data-fakultas', DataFakultasController::class);
    Route::resource('/data-pengguna', DataPenggunaController::class)->except('edit', 'update', 'updatePassword');
    Route::post('/data-pengguna/create', [DataPenggunaController::class, 'create'])->name('create');
    Route::post('/data-pengguna/store', [DataPenggunaController::class, 'store'])->name('store');
    Route::get('/data-pengguna/edit/{user:id}', [DataPenggunaController::class, 'edit']);
    Route::post('/data-pengguna/update/{user:id}', [DataPenggunaController::class, 'update']);
    Route::get('/data-pengguna/show/{user:id}', [DataPenggunaController::class, 'sho    w']); 
    Route::put('/data-pengguna/update-password/{user:slug}', [DataPenggunaController::class, 'updatePassword']);

    //program studi
    Route::resource('/data-programstudi', DataProgramStudiController::class);
    Route::get('/getdataprogramstudis/{id}', [DataProgramStudiController::class, 'getdataprogramstudis']);

    //fakultas
    Route::resource('/data-fakultas', DataFakultasController::class);
    Route::get('/getdatafakultas/{id}', [DataFakultasController::class, 'getdatafakultas']);

    
    Route::resource('/pemagangan', PemaganganController::class)->except('edit', 'update');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(AuthMiddleware::class);

