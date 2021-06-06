<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PerdaController;
use App\Http\Controllers\PerdaPelanggaranController;
use App\Http\Controllers\PerdaSangsiController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\RabTempController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RestokController;
use App\Http\Controllers\UserManagementController;
use App\Models\Barang;
use App\Models\PerdaPelanggaran;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'auth'])->name('/');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/password', [ResetPasswordController::class, 'index'])->name('password.index');
Route::post('/password/kirim', [ResetPasswordController::class, 'kirim'])->name('password.kirim');
Route::get('/password/forgot/{token}', [ResetPasswordController::class, 'forgot'])->name('password.forgot');
Route::post('/password/ubah', [ResetPasswordController::class, 'ubah'])->name('password.ubah');

// admin
Route::group(['middleware' => ['role:admin']], function () {
    // user management
    Route::get('/user/{jenis}', [UserManagementController::class, 'index'])->name('user.index');
    Route::post('/user/store', [UserManagementController::class, 'store'])->name('user.store');
    Route::post('/user/edit', [UserManagementController::class, 'edit'])->name('user.edit');
    Route::post('/user/update', [UserManagementController::class, 'update'])->name('user.update');
    Route::post('/user/hapus', [UserManagementController::class, 'hapus'])->name('user.hapus');


    // kelola peraturan daerah
    Route::get('/perda', [PerdaController::class, 'index'])->name('perda.index');
    Route::post('/perda/store', [PerdaController::class, 'store'])->name('perda.store');
    Route::post('/perda/update', [PerdaController::class, 'update'])->name('perda.update');
    Route::get('/perda/edit/{id}', [PerdaController::class, 'edit'])->name('perda.edit');
    Route::post('/perda/hapus', [PerdaController::class, 'hapus'])->name('perda.hapus');

    // kelola detail pelanggaran perda
    Route::post('/PerdaPelanggaran/store', [PerdaPelanggaranController::class, 'store'])->name('PerdaPelanggaran.store');
    Route::post('/PerdaPelanggaran/hapus', [PerdaPelanggaranController::class, 'hapus'])->name('PerdaPelanggaran.hapus');
    Route::post('/PerdaPelanggaran/edit', [PerdaPelanggaranController::class, 'edit'])->name('PerdaPelanggaran.edit');

    // kelola detail sangsi perda
    Route::post('/sangsi/store', [PerdaSangsiController::class, 'store'])->name('sangsi.store');
    Route::post('/sangsi/hapus', [PerdaSangsiController::class, 'hapus'])->name('sangsi.hapus');
    Route::post('/sangsi/edit', [PerdaSangsiController::class, 'edit'])->name('sangsi.edit');


    // approve pelanggaran
    Route::get('/pelanggaran/terima/{id}', [PelanggaranController::class, 'terima'])->name('pelanggaran.terima');
});

Route::group(['middleware' => ['role:petugas|admin|pimpinan']], function () {
    // barang pelanggaran
    Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('pelanggaran.index');

    // kelola cetak
    Route::post('/cetak', [CetakController::class, 'cetak'])->name('cetak');

    // kelola ganti passsword


    Route::post('/user/resetpw', [UserManagementController::class, 'resetpw'])->name('user.resetpw');
});

Route::group(['middleware' => ['role:petugas']], function () {
    // barang pelanggaran
    Route::get('/pelanggaran/baru', [PelanggaranController::class, 'baru'])->name('pelanggaran.baru');
    Route::post('/pelanggaran/store', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
    Route::get('/pelanggaran/edit/{id}', [PelanggaranController::class, 'edit'])->name('pelanggaran.edit');
    Route::post('/pelanggaran/update', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
    Route::POST('/pelanggaran/hapus/', [PelanggaranController::class, 'hapus'])->name('pelanggaran.hapus');

    // ajax 
    Route::get('/getPerda/{id}', [PerdaController::class, 'getPerdaById'])->name('getPerda');
    Route::get('/getPelanggaran/{no_ktp}', [PelanggaranController::class, 'getPelanggaran'])->name('getPelanggaran');
});
