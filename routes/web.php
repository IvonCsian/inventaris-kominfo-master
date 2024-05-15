<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryBarangController;
use App\Http\Controllers\JenisKategoriController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LogUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    // jenis kategori
    Route::resource('jenis-kategori',JenisKategoriController::class);
    // kategori
    Route::resource('kategori',KategoriController::class);
    // User
    Route::get('pdf',[BarangController::class,'pdfDownload'])->name('barang.pdf');
    Route::delete('{id}/delete-permanent-barang', [BarangController::class, 'deletePermanent'])->name('barang.deletePermanent');
    Route::post('{id}/restore-barang',[BarangController::class,'restore'])->name('barang.restore');
    Route::resource('barang', BarangController::class);
    Route::resource('user', UserController::class);
    // log user
    Route::get('log-user',[LogUserController::class,'loguser'])->name('log.user');
    // history barang
    Route::get('history-barang',[HistoryBarangController::class, 'history'])->name('history.barang');

});

require __DIR__.'/auth.php';
