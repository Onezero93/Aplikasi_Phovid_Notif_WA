<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RekeningController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/log', [LoginController::class, 'login'])->name('login.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//datapengguna
Route::get('/datapengguna', [UserController::class, 'tampilData'])->name('pengguna.datapengguna');
Route::post('/tambahdatapengguna', [UserController::class, 'tambahData'])->name('pengguna.tambah');
Route::put('/perbaruipengguna/{id_user}', [UserController::class, 'perbaruiData'])->name('pengguna.perbarui');
// Route::get('/editpengguna/{id_user}', [UserController::class, 'edit'])->name('pengguna.edit');
Route::delete('/hapuspengguna/{id_user}', [UserController::class, 'hapusData'])->name('pengguna.hapus');

//jasa
Route::get('/datajasa', [JasaController::class, 'tampilJasa'])->name('jasa.datajasa');
Route::post('/tambahdatajasa', [JasaController::class, 'tambahJasa'])->name('jasa.tambah');
Route::post('/perbaruijasa/{id_jasa}', [JasaController::class, 'perbaruiJasa'])->name('jasa.perbarui');
Route::get('/detailjasa/{id_jasa}', [JasaController::class, 'detailJasa'])->name('jasa.detail');
Route::delete('/hapusjasa/{id_jasa}', [JasaController::class, 'hapusDataJasa'])->name('jasa.hapus');

//pelanggan pemesanan
Route::get('/datapemesanan', [PemesananController::class, 'tampilPemesanan'])->name('pemesanan.datapemesanan');
Route::put('/pemesanan/update-status/{id_pemesanan}', [PemesananController::class, 'updateStatus'])->name('status.perbarui');
Route::post('/kirim-wa', [PemesananController::class, 'kirimWaAjax'])->name('kirim.wa');




//rekenig
Route::get('/datarekening', [RekeningController::class, 'tampilRekening'])->name('rekening.datarekening');
Route::post('/tambahrekening', [RekeningController::class, 'tambahRekening'])->name('rekening.tambah');
Route::put('/perbaruirekening/{id_rekening}', [RekeningController::class, 'perbaruiDataRekening'])->name('rekening.perbarui');
Route::delete('/hapusrekening/{id_rekening}', [RekeningController::class, 'hapusDataRekening'])->name('rekening.hapus');
// Route::get('/login', function () {
//     return view('auth.login');
// });
Route::get('/', [PelangganController::class, 'tampilJasaHome'])->name('jasa.jasahome');
Route::get('/pesanan/{id_jasa}', [PelangganController::class, 'buatPesanan'])->name('pesanan.jasa');
Route::post('/simpan-pesanan', [PelangganController::class, 'simpanPesanan'])->name('simpan.pesanan');


