<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PegawaiController::class,'index']);
Route::get('/add', [PegawaiController::class,'add']);
Route::post('/add', [PegawaiController::class,'store'])->name('tambah');
Route::put('/edit/{pegawai}', [PegawaiController::class,'update'])->name('update');
Route::delete('/delete/{pegawai}', [PegawaiController::class,'delete'])->name('delete');
Route::get('/detail/{pegawai}', [PegawaiController::class,'detail']);
Route::post('/berkas/{id}', [PegawaiController::class,'berkas'])->name('berkas');
Route::delete('/hapus_berkas/{berkas}', [PegawaiController::class,'hapus_berkas'])->name('hapus_berkas');
Route::delete('/hapus/{berkas:pegawai_id}', [PegawaiController::class,'hapus_all'])->name('hapus');
