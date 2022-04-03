<?php

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoggingController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanPengajuanController;

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

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function(){
    


Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/',[HomeController::class, 'show']);
Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
Route::get('/pembelian/detail/data/{id}', [PembelianController::class, 'detail_data'])->name('pembelian.detail');



Route::post('/ditarik',[BarangController::class, 'updateDitarik'])->name('ditarik');
Route::post('/terpenuhi',[PengajuanController::class, 'updateTerpenuhi'])->name('terpenuhi');



Route::prefix('/admin')->group(function(){
    Route::get('/', [AdminController::class, 'show']);
    Route::resource('/produk', ProdukController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/pemasok', PemasokController::class);
    Route::resource('/pelanggan', PelangganController::class);
    Route::resource('/pembelian', PembelianController::class);
    Route::resource('/penjualan', PenjualanController::class);
    Route::resource('/pengajuan', PengajuanController::class);
    Route::resource('/logging', LoggingController::class);
    Route::get('/laporan/pendapatan', [LaporanController::class, 'pendapatan'])->name('laporan.pendapatan');
    Route::resource('/user', UserController::class);
    });
    Route::get('/laporan/pendapatan/data/{tgl_awal}/{tgl_akhir}', [LaporanController::class, 'dataPendapatan'])->name('laporan.data_pendapatan');
    Route::get('/laporan/pendapatan/export/pdf/{tgl_awal}/{tgl_akhir}', [LaporanController::class, 'exportPendapatanPDF'])->name('laporan.pdf_pendapatan');
    Route::get('/laporan/pengajuan/export/pdf/', [LaporanPengajuanController::class, 'exportPengajuanPDF'])->name('pengajuan.pdf');
    Route::get('/laporan/pengajuan/export/excel/', [PengajuanController::class, 'export_excel'])->name('pengajuan.excel');
});