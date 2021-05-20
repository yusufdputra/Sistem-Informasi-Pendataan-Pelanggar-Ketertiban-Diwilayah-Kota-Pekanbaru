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

// admin

Route::group(['middleware' => ['role:admin']], function () {
    // user management
    Route::get('/user/{jenis}', [UserManagementController::class, 'index'])->name('user.index');
    Route::post('/user/store', [UserManagementController::class, 'store'])->name('user.store');
    Route::post('/user/edit', [UserManagementController::class, 'edit'])->name('user.edit');
    Route::post('/user/update', [UserManagementController::class, 'update'])->name('user.update');
    Route::post('/user/hapus', [UserManagementController::class, 'hapus'])->name('user.hapus');
    Route::post('/user/resetpw', [UserManagementController::class, 'resetpw'])->name('user.resetpw');
    
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



     // kelola barang
     Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
     Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang/edit');
     Route::POST('/barang/update/', [BarangController::class, 'update'])->name('barang.update');
     Route::POST('/barang/hapus/', [BarangController::class, 'hapus'])->name('barang.hapus');

   
    // kelola kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::POST('/kategori/edit', [KategoriController::class, 'update'])->name('kategori.update');
    Route::POST('/kategori/hapus/', [KategoriController::class, 'hapus'])->name('kategori.hapus');

    // kelola rab
    Route::get('/rab', [RabController::class, 'index'])->name('rab.index');
    Route::get('/rab/edit/{id}', [RabController::class, 'edit'])->name('rab.edit');
    Route::get('/rab/cetak/{id}', [RabController::class, 'cetak'])->name('rab.cetak');
    Route::POST('/rab/delete/', [RabController::class, 'hapus'])->name('rab.delete');

    // kelola edit rab
    Route::POST('/rab/edit/selesai/', [RabController::class, 'editSelesai'])->name('rab.edit.selesai');
    Route::POST('/rab/edit/update/', [RabController::class, 'editUpdate'])->name('rab.edit.update');
    Route::post('/rab/edit/store', [RabController::class, 'editStore'])->name('rab.edit.store');
    Route::POST('/rab/hapus/', [RabController::class, 'editHapus'])->name('rab.edit.hapus');

    // kelola rab temp
    Route::get('/rabtemp', [RabTempController::class, 'index'])->name('rabtemp.index');
    Route::post('/rabtemp/store', [RabTempController::class, 'store'])->name('rabtemp.store');
    Route::get('/rabtemp/edit/{id}', [RabTempController::class, 'edit'])->name('rabtemp/edit');
    Route::POST('/rabtemp/update/', [RabTempController::class, 'update'])->name('rabtemp.update');
    Route::POST('/rabtemp/hapus/', [RabTempController::class, 'hapus'])->name('rabtemp.hapus');
    Route::POST('/rabtemp/selesai/', [RabTempController::class, 'selesai'])->name('rabtemp.selesai');

    // kelola ajax
    Route::get('/GetBarangByKategori/{id}', [AjaxController::class, 'GetBarangByKategori'])->name('GetBarangByKategori');


});

Route::group(['middleware' => ['role:admin|pegawai']], function () {

    // barang masuk
    Route::post('masuk/store', [BarangMasukController::class, 'store'])->name('masuk.store');
    Route::get('/masuk/edit/{id}', [BarangMasukController::class, 'edit'])->name('masuk/edit');
    Route::POST('/masuk/update/', [BarangMasukController::class, 'update'])->name('masuk.update');
    Route::POST('/masuk/hapus/', [BarangMasukController::class, 'hapus'])->name('masuk.hapus');

    // barang keluar
    Route::post('keluar/store', [BarangKeluarController::class, 'store'])->name('keluar.store');
    Route::get('/keluar/edit/{id}', [BarangKeluarController::class, 'edit'])->name('keluar/edit');
    Route::POST('/keluar/update/', [BarangKeluarController::class, 'update'])->name('keluar.update');
    Route::POST('/keluar/hapus/', [BarangKeluarController::class, 'hapus'])->name('keluar.hapus');
  
    // kelola restok barang 
    Route::post('restok/store', [RestokController::class, 'store'])->name('restok.store');
    Route::get('/restok/edit/{id}', [RestokController::class, 'edit'])->name('restok/edit');
    Route::POST('/restok/update/', [RestokController::class, 'update'])->name('restok.update');
    Route::POST('/restok/terima/', [RestokController::class, 'terima'])->name('restok.terima');
    Route::POST('/restok/hapus/', [RestokController::class, 'hapus'])->name('restok.hapus');
});

Route::group(['middleware' => ['role:petugas|admin|pimpinan']], function () {  
    // barang pelanggaran
    Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('pelanggaran.index');
    
    // kelola cetak
    Route::post('/cetak/cetak', [CetakController::class, 'cetak'])->name('cetak.cetak');
});

Route::group(['middleware' => ['role:petugas']], function () {  
    // barang pelanggaran
    Route::get('/pelanggaran/baru', [PelanggaranController::class, 'baru'])->name('pelanggaran.baru');
    Route::post('/pelanggaran/store', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
    Route::get('/pelanggaran/edit/{id}', [PelanggaranController::class, 'edit'])->name('pelanggaran.edit');
    Route::post('/pelanggaran/update', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
    Route::POST('/pelanggaran/hapus/', [PelanggaranController::class, 'hapus'])->name('pelanggaran.hapus');
  
    // kelola cetak
    Route::post('/cetak/cetak', [CetakController::class, 'cetak'])->name('cetak.cetak');

    // ajax 
    Route::get('/getPerda/{id}', [PerdaController::class, 'getPerdaById'])->name('getPerda');
    Route::get('/getPelanggaran/{no_ktp}', [PelanggaranController::class, 'getPelanggaran'])->name('getPelanggaran');
});


Route::get('/getBarangById/{id}', [BarangController::class, 'getBarangById'])->name('getBarangById');