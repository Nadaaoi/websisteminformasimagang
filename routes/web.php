<?php

use App\Http\Controllers\admin\DataPenggunaController;
use App\Http\Controllers\admin\DataPenggunaAdminController;
use App\Http\Controllers\admin\DataProgramStudiController;
use App\Http\Controllers\admin\DaftarPendaftarController;
use App\Http\Controllers\admin\DataFakultasController;
use App\Http\Controllers\user\pemaganganController;
use App\Http\Controllers\user\LogbookController;
use App\Http\Controllers\user\PemberitahuanController;
use App\Http\Controllers\user\BimbinganController;
use App\Http\Controllers\user\LaporanAkhirController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanBimbinganController;
use App\Http\Controllers\LaporanLogbookController;
use App\Http\Controllers\laporanLpController;
use App\Http\Controllers\Pembimbing\LaporanBimbinganPembimbingController;
use App\Http\Controllers\Pembimbing\LaporanLogbookPembimbingController;
use App\Http\Controllers\Pembimbing\laporanLpPembimbingController;
use App\Http\Controllers\PesertamagangController;
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

// Route::get('/dashboard', function () {
//     return view('Dashboard');
// });


    Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('update-password');

    // SUPER ADMIN
    // pengguna super admin
    Route::resource('/data-pengguna', DataPenggunaController::class)->except('edit', 'updatePassword', 'destroy');
    Route::post('/data-pengguna/create', [DataPenggunaController::class, 'create'])->name('create');
    Route::post('/data-pengguna/store', [DataPenggunaController::class, 'store'])->name('store');
    Route::get('/data-pengguna/show/{user:id}', [DataPenggunaController::class, 'show']); 
    Route::post('/data-pengguna/update-password/{user:slug}', [DataPenggunaController::class, 'updatePassword'])->name('update.password');
    Route::delete('/data-pengguna/destroy/{user:id}', [DataPenggunaController::class, 'destroy'])->name('hapus.pengguna');


    //program studi
    Route::resource('/data-programstudi', DataProgramStudiController::class);
    Route::get('/getdataprogramstudis/{id}', [DataProgramStudiController::class, 'getdataprogramstudis']);

    //fakultas
    Route::resource('/data-fakultas', DataFakultasController::class);
    Route::get('/getdatafakultas/{id}', [DataFakultasController::class, 'getdatafakultas']);


    ///////////////////////////////
    // ADMIN
    // pengguna admin
    // Route::middleware('admin')->group(function (){
        Route::resource('/data-pengguna-admin', DataPenggunaAdminController::class)->except('edit', 'update', 'updatePassword');
        Route::post('/data-pengguna-admin/create', [DataPenggunaAdminController::class, 'create']);
        Route::post('/data-pengguna-admin/store', [DataPenggunaAdminController::class, 'store']);
        Route::get('/data-pengguna-admin/edit/{user:id}', [DataPenggunaAdminController::class, 'edit']);
        Route::post('/data-pengguna-admin/update/{user:id}', [DataPenggunaAdminController::class, 'update']);
        Route::get('/data-pengguna-admin/show/{user:id}', [DataPenggunaAdminController::class, 'show']); 
        Route::put('/data-pengguna-admin/update-password/{user:slug}', [DataPenggunaAdminController::class, 'updatePassword']);
    
        Route::resource('/daftar-pendaftar', DaftarPendaftarController::class)->except(['show', 'edit', 'update']);
        Route::get('/daftar-pendaftar/show/{pemagangan:slug}', [DaftarPendaftarController::class, 'show']); /**finish */
        Route::get('/daftar-pendaftar/edit/{pemagangan:slug}', [DaftarPendaftarController::class, 'edit']);
        Route::put('/daftar-pendaftar/update/{pemagangan:id}', [DaftarPendaftarController::class, 'update'])->name('daftar-pendaftar.update');
        Route::get('/daftar-pendaftar/showbelummagang/{pemagangan:slug}', [DaftarPendaftarController::class, 'showbelummagang']);
        // Route::get('/daftar-pendaftar/showmagang/{pemagangan:slug}', [DaftarPendaftarController::class, 'showmmagang']);


    ///////////////////////////////////////////////
    // USER

    Route::resource('/pemagangan', PemaganganController::class)->except('edit', 'update', 'show');
    Route::get('/pemagangan/show/{pemagangan:slug}', [PemaganganController::class, 'show']);  
    Route::resource('/pemberitahuan', PemberitahuanController::class);

    Route::middleware(['CheckStatusAkun'])->group(function () {

    Route::middleware(['checkPemaganganDates'])->group(function () {
            // Rute-rute lain yang memerlukan middleware checkPemaganganDates
    Route::resource('/logbook', LogbookController::class);
    Route::post('/logbook/store', [LogbookController::class, 'store']);
    });

    Route::resource('/bimbingan', BimbinganController::class);
    Route::get('/bimbingan/show/{id}', [BimbinganController::class, 'show']); 
    // Route::get('/bimbingan/show/', BimbinganController::class, 'show');
    Route::post('/bimbingan/store', [BimbinganController::class, 'store']); 

    // Route::get('/laporanakhir/show', LaporanAkhirController::class, 'show');
    Route::resource('/laporanakhir', LaporanAkhirController::class);
    });
    

    Route::resource('/pesertamagang',PesertamagangController::class);
    
    Route::resource('/laporanbimbingan',LaporanBimbinganController::class)->except('show');
    Route::get('/laporanbimbingan/show/{user_id}', [LaporanBimbinganController::class, 'show'])->name('laporanbimbingan.show');
    Route::get('/laporanbimbingan/showpdf/{user_id}', [LaporanBimbinganController::class, 'showPdf'])->name('laporanbimbingan.showpdf');
    Route::get('/laporanbimbingan/showexcel/{user_id}', [LaporanBimbinganController::class, 'exportExcel'])->name('laporanbimbingan.showexcel');

    Route::resource('/laporanlogbook',LaporanLogbookController::class)->except('show');
    Route::get('/laporanlogbook/show/{user_id}', [LaporanLogbookController::class, 'show'])->name('laporanlogbook.show');
    Route::get('/laporanlogbook/showpdf/{user_id}', [LaporanLogbookController::class, 'showPdf'])->name('laporanlogbook.showpdf');
    Route::get('/laporanlogbook/showexcel/{user_id}', [LaporanLogbookController::class, 'exportExcel'])->name('laporanlogbook.showexcel');

    Route::resource('/laporanlp',LaporanLpController::class)->except('show');
    Route::get('/laporanlp/show/{user_id}', [LaporanLpController::class, 'show'])->name('laporanlp.show');

    Route::get('/export/excel/laporanlp', [LaporanLpController::class, 'exportExcel'])->name('exportlp.excel');
    Route::get('/export/pdf/laporanlp', [LaporanLpController::class, 'exportPDF'])->name('exportlp.PDF');

    // Route::get('/export/excel/logbook', [LaporanLogbookController::class, 'exportExcel'])->name('exportlogbook.excel');
    // Route::get('/export/pdf/logbook/{user_id}', [LaporanLogbookController::class, 'exportPDF'])->name('exportlogbook.PDF');

    // Route::get('/export/excel/bimbingan', [LaporanBimbinganController::class, 'exportExcel'])->name('exportbimbingan.excel');
    // // Route::get('/export/pdf/bimbingan', [LaporanBimbinganController::class, 'exportPDF'])->name('exportbimbingan.PDF');




      ///////////////////////////////////////////////
    // PEMBIMBING
    Route::resource('/laporanbimbinganpembimbing',LaporanBimbinganPembimbingController::class)->except('show', 'simpanKonfirmasi');
    Route::get('/laporanbimbinganpembimbing/show/{user_id}', [LaporanBimbinganPembimbingController::class, 'show']);
    Route::post('/simpan-konfirmasi', [LaporanBimbinganPembimbingController::class, 'simpanKonfirmasi'])->name('simpan.konfirmasi');


    Route::resource('/laporanlogbookpembimbing',LaporanLogbookPembimbingController::class)->except('show');
    Route::get('/laporanlogbookpembimbing/show/{user_id}', [LaporanLogbookPembimbingController::class, 'show']);

    Route::resource('/laporanlppembimbing',laporanLpPembimbingController::class)->except('show');
    Route::get('/laporanlppembimbing/show/{user_id}', [laporanLpPembimbingController::class, 'show']);

});


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(AuthMiddleware::class);

