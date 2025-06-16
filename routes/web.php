<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalPraktekController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\ImageController;

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

Route::resource('pasien', PasienController::class);
Route::resource('dokter', DokterController::class);
Route::resource('jadwal_praktek', JadwalPraktekController::class);
Route::resource('antrian', AntrianController::class);

Route::get('/pendaftaran-ktp', function () {
    return 'Selamat datang di pendaftaran KTP Online. Silakan isi data diri Anda.';
})->middleware('check.age');

Route::get('/upload', [ImageController::class, 'create']);
Route::post('/upload', [ImageController::class, 'store'])->name('image.upload');