<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalPraktekController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pasien\DashboardController;
use App\Http\Controllers\Pasien\PasienAntrianController;
use App\Http\Controllers\Pasien\PasienProfileController;

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

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'requestOtp']);
Route::get('login/otp', [LoginController::class, 'showOtpForm'])->name('login.otp');
Route::post('login/otp', [LoginController::class, 'verifyAndLogin']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth.admin'])->prefix('admin')->group(function () {
    Route::get('/', function() {
        return redirect()->route('dokter.index');
    })->name('admin.dashboard');

    Route::resource('pasien', PasienController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('jadwal-praktek', JadwalPraktekController::class);
    Route::resource('antrian', AntrianController::class);
});

Route::middleware(['auth.pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/antrian/ambil', [PasienAntrianController::class, 'create'])->name('antrian.create');
    Route::post('/antrian/ambil', [PasienAntrianController::class, 'store'])->name('antrian.store');
    Route::get('/edit-profile', [PasienProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/edit-profile', [PasienProfileController::class, 'update'])->name('profile.update');
});

Route::get('/pendaftaran-ktp', function () {
    return 'Selamat datang di pendaftaran KTP Online. Silakan isi data diri Anda.';
})->middleware('check.age');

Route::get('/upload', [ImageController::class, 'create']);
Route::post('/upload', [ImageController::class, 'store'])->name('image.upload');