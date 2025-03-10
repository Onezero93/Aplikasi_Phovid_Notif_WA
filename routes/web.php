<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\PelangganController;

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
Route::get('/datapengguna', [UserController::class, 'tampilData'])->name('pengguna.datapengguna');
Route::post('/tambahdatapengguna', [UserController::class, 'tambahData'])->name('pengguna.tambah');
Route::put('/perbaruipengguna/{id_user}', [UserController::class, 'perbaruiData'])->name('pengguna.perbarui');
Route::get('/editpengguna/{id_user}', [UserController::class, 'edit'])->name('pengguna.edit');
Route::delete('/hapuspengguna/{id_user}', [UserController::class, 'hapusData'])->name('pengguna.hapus');

//jasa
Route::get('/datajasa', [JasaController::class, 'tampilJasa'])->name('jasa.datajasa');
Route::post('/tambahdatajasa', [JasaController::class, 'tambahJasa'])->name('jasa.tambah');
Route::post('/perbaruijasa/{id_jasa}', [JasaController::class, 'perbaruiJasa'])->name('jasa.perbarui');
Route::get('/editjasa/{id_jasa}', [JasaController::class, 'editJasa'])->name('jasa.edit');
Route::get('/detailjasa/{id_jasa}', [JasaController::class, 'detailJasa'])->name('jasa.detail');

// Route::get('/', function () {
//     return view('pelanggan.home');
// });
//pelanggan
Route::get('/', [PelangganController::class, 'tampilJasaHome'])->name('jasa.jasahome');
Route::get('/pesanan/{id_jasa}', [PelangganController::class, 'buatPesanan'])->name('pesanan.jasa');

