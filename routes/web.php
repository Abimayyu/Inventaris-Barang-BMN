<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Otentikasi;
use App\Http\Controllers\AdminController;
use App\Models\DistribusiBarang;



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

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('home', function () {
    return view('layout.home');
});



Route::middleware(['auth'])->group(function () 
{

    Route::middleware(['IsPengelola'])->group(function () 
    {
         // Data Penguna
        Route::get('dataPengguna', [AdminController::class, 'Pengguna']);
        Route::get('tambahDataPengguna', [AdminController::class, 'tambahDataPengguna']);
        Route::get('editDataPengguna/{id}', [AdminController::class, 'editDataPengguna']);
        Route::get('resetPasswordDataPengguna/{id}', [AdminController::class, 'ResetPassword']);
        Route::get('hapusDataPengguna/{id}', [AdminController::class, 'hapusDataPengguna']); 
        Route::post('tambahDataPenggunaAksi', [AdminController::class, 'tambahDataPenggunaAksi']);
        Route::post('editDataPenggunaAksi', [AdminController::class, 'editDataPenggunaAksi']);

         // Data Barang
        Route::get('daftar-data-barang', [AdminController::class, 'DaftarDataBarang']);
        Route::post('daftar-data-barang-aksi', [AdminController::class, 'DaftarDataBarangAksi']);
        Route::get('edit-data-barang/{id}', [AdminController::class, 'EditDataBarang']);
        Route::post('edit-data-barang-aksi', [AdminController::class, 'EditDataBarangAksi']);
        Route::get('hapus-data-barang/{id}', [AdminController::class, 'HapusDataBarang']);

        //Data Distribusi Barang
        Route::get('tambah-distribusi', [AdminController::class, 'TambahDistribusi']);
        // Route::get('tambah-distribusi', [AdminController::class, 'TambahDistribusi']);
        Route::post('tambah-distribusi-aksi', [AdminController::class, 'TambahDistribusiAksi']);
        Route::get('edit-distribusi-barang/{id}', [AdminController::class, 'EditDistribusi']);
        Route::get('hapus-barang-distribusi/{id}', [AdminController::class, 'HapusBarangDistribusi']);
        Route::post(' edit-distribusi-barang-aksi', [AdminController::class, 'EditDistribusiAksi']);
        
         // Data Unit Barang
        Route::get('tambah-unit-barang/{id}', [AdminController::class, 'TambahUnitBarang']);
        Route::get('edit-unit-barang/{id}', [AdminController::class, 'EditUnitBarang']);
        Route::post('tambah-unit-barang-aksi', [AdminController::class, 'TambahUnitBarangAksi']);
        Route::post('edit-unit-barang-aksi', [AdminController::class, 'EditUnitBarangAksi']);
        Route::get('detail-unit-barang/{id}', [AdminController::class, 'DetailUnitBarang']);

        //Data Peminjaman
        Route::get('tambah-peminjaman-barang', [AdminController::class, 'TambahPeminjamanBarang']);
        Route::get('edit-peminjaman-barang/{id}', [AdminController::class, 'EditPeminjamanBarang']);
        Route::get('hapus-peminjaman-barang/{id}', [AdminController::class, 'HapusPeminjamanBarang']);
        Route::get('hapus-barang-peminjaman/{id}', [AdminController::class, 'HapusBarangPeminjaman']);
        Route::get('kembalikan-barang/{id}', [AdminController::class, 'Pengembalian']);
        Route::post('tambah-peminjaman-barang-aksi', [AdminController::class, 'TambahPeminjamanBarangAksi']);
        Route::post('edit-peminjaman-barang-aksi', [AdminController::class, 'EditPeminjamanBarangAksi']);


        Route::get('ambilQrcode', [AdminController::class, 'Qrcode']);
        Route::get('cetak-qr-code/{id}', [AdminController::class, 'CetakQrcode']);
    });
    Route::middleware(['IsVerifikator'])->group(function () 
    {
        Route::get('lihat-verifikasi-barang', [AdminController::class, 'VerifBarang']);
        Route::get('lihat-verifikasi-distribusi', [AdminController::class, 'VerifDistribusi']);
        Route::get('verifikasi-distribusi/{id}', [AdminController::class, 'EditVerifDistribusi']);
        Route::post('verifikasi-barang/{id}', [AdminController::class, 'EditVerifBarang']);

        
    });

    Route::get('dashboard',[AdminController::class, 'Dashboard']);
    Route::get('laporan',[AdminController::class, 'Laporan']);
    Route::get ('laporan-peminjaman',[AdminController::class, 'LaporanPeminjaman']);
    Route::get ('laporan-distribusi',[AdminController::class, 'LaporanDistribusi']);
   
   

    // Data Barang
    Route::get('dataBarang', [AdminController::class, 'Barang']);
    Route::get('lihat-data-barang/{id}', [AdminController::class, 'LihatBarang']);
    Route::get('hapus-unit-barang/{id}', [AdminController::class, 'HapusUnitBarang']);

   

    //Data Peminjaman
    Route::get('dataPeminjaman', [AdminController::class, 'Peminjaman']);
    Route::get('lihat-detail-peminjaman/{id}', [AdminController::class, 'LihatPeminjamanBarang']);

    //Distribusi Barang
    Route::get('distribusiDataBarang', [AdminController::class, 'DistribusiBarang']);
    Route::get('hapus-distribusi/{id}', [AdminController::class, 'HapusDistribusi']);

});


//AUTH
Route::post('otentikasi', [Otentikasi::class, 'otentikasi']);
Route::get('logout', [Otentikasi::class, 'logout']);
















