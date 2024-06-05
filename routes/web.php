<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\DiterimaController;
use App\Http\Controllers\DitolakController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\InfoRuanganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Session;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BarangController;
/*
use App\Http\Controllers\JadwalController;
*/
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatkulController;


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
    return view('welcome');
});

//Route Memanggil View Asli
Route::get('/register', function () {
    return view('register');
})->name('register');

//Route Memanggil View Asli
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/peminjaman', function () {
    return view('peminjaman');
})->name('peminjaman');

Route::get('/pengembalian', function () {
    return view('pengembalian');
})->name('pengembalian');


//Route LoginUserController
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/login', [LoginController::class, 'login']);

Route::get('/peminjaman', [PeminjamanController::class, 'index_peminjaman']);
Route::post('/peminjaman', [PeminjamanController::class, 'input_peminjaman'])->name('peminjaman');;


//Persetujuan
Route::get('/persetujuan', [PersetujuanController::class, 'index'])->name('persetujuan.index');

Route::post('/persetujuan/terima/{id}', [PersetujuanController::class, 'terima'])->name('peminjaman.terima');
Route::post('/persetujuan/tolak/{id}', [PersetujuanController::class, 'tolak'])->name('peminjaman.tolak');

// Diterima
Route::get('/diterima', [DiterimaController::class, 'index'])->name('diterima.index');
Route::post('/diterima/riwayat/{id}', [DiterimaController::class, 'riwayat'])->name('diterima.riwayat');

//Riwayat
Route::get('/riwayat-list-admin', [riwayatController::class, 'index'])->name('riwayat.index');

// Ditolak
Route::get('/ditolak', [DitolakController::class, 'index'])->name('ditolak.index');

//Riwayat List Admin
Route::get('/riwayat-list-admin', [riwayatController::class, 'index'])->name('riwayat.index');
Route::get('/filter', [RiwayatController::class, 'filter'])->name('filter');

//Riwayat Diagram Admin
Route::get('/riwayat-diagram-admin', [riwayatController::class, 'showDiagram'])->name('riwayat.showDiagram');
Route::get('/riwayat-diagram-filter', [RiwayatController::class, 'filterDiagram'])->name('riwayat.filterDiagram');

//Riwayat List Mahasiswa
Route::get('/riwayat-list-mahasiswa', [riwayatController::class, 'index_mahasiswa'])->name('riwayat.index_mahasiswa');
Route::get('/filter_mahasiswa', [RiwayatController::class, 'filter_mahasiswa'])->name('filter_mahasiswa');

//Riwayat Diagram Mahasiswa
Route::get('/riwayat-diagram-mahasiswa', [riwayatController::class, 'showDiagram_mahasiswa'])->name('riwayat.showDiagram_mahasiswa');
Route::get('/riwayat-diagram-filter-mahasiswa', [RiwayatController::class, 'filterDiagram_mahasiswa'])->name('riwayat.filterDiagram_mahasiswa');

//Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

//Info Ruangan
Route::get('/inforuangan-mahasiswa', [InfoRuanganController::class, 'index'])->name('inforuangan-mahasiswa.index');

//Info Ruangan Admin
Route::get('/inforuangan-admin', [InfoRuanganController::class, 'index_admin'])->name('inforuangan-admin.index_admin');

// Ruangan
Route::get('/mengelola-ruangan', [RuanganController::class, 'index_mengelola_ruangan']);

Route::get('/tambah-ruangan', [RuanganController::class, 'index_tambah_ruangan']);
Route::post('/tambah-ruangan', [RuanganController::class, 'tambah_ruangan']);

Route::get('/ubah-ruangan/{idruangan}', [RuanganController::class, 'index_ubah_ruangan'])
->name('ubah-ruangan');
Route::patch('/ubah-ruangan/{idruangan}', [RuanganController::class, 'ubah_ruangan'])
->name('ubah-ruangan');

Route::delete('/hapus-ruangan/{idruangan}', [RuanganController::class, 'hapus_ruangan']);

// Barang
Route::get('/mengelola-barang', [BarangController::class, 'index_mengelola_barang']);

Route::get('/tambah-barang', [BarangController::class, 'index_tambah_barang']);
Route::post('/tambah-barang', [BarangController::class, 'tambah_barang']);

Route::get('/ubah-barang/{idbarang}', [BarangController::class, 'index_ubah_barang'])
->name('ubah-barang');
Route::patch('/ubah-barang/{idbarang}', [BarangController::class, 'ubah_barang'])
->name('ubah-barang');

Route::delete('/hapus-barang/{idbarang}', [BarangController::class, 'hapus_barang']);

/*
// Jadwal
Route::get('/mengelola-jadwal', [JadwalController::class, 'index_mengelola_jadwal']);

Route::get('/tambah-jadwal', [JadwalController::class, 'index_tambah_jadwal']);
Route::post('/tambah-jadwal', [JadwalController::class, 'tambah_jadwal']);

Route::get('/ubah-jadwal/{idjadwal}', [JadwalController::class, 'index_ubah_jadwal'])
->name('ubah-jadwal');
Route::patch('/ubah-jadwal/{idjadwal}', [JadwalController::class, 'ubah_jadwal'])
->name('ubah-jadwal');

Route::delete('/hapus-jadwal/{idjadwal}', [JadwalController::class, 'hapus_jadwal']);
*/

// Prodi
Route::get('/mengelola-prodi', [ProdiController::class, 'index_mengelola_prodi']);

Route::get('/tambah-prodi', [ProdiController::class, 'index_tambah_prodi']);
Route::post('/tambah-prodi', [ProdiController::class, 'tambah_prodi']);

Route::get('/ubah-prodi/{idprodi}', [ProdiController::class, 'index_ubah_prodi'])
->name('ubah-prodi');
Route::patch('/ubah-prodi/{idprodi}', [ProdiController::class, 'ubah_prodi'])
->name('ubah-prodi');

Route::delete('/hapus-prodi/{idprodi}', [ProdiController::class, 'hapus_prodi']);

// Kelas
Route::get('/mengelola-kelas', [KelasController::class, 'index_mengelola_kelas']);

Route::get('/tambah-kelas', [KelasController::class, 'index_tambah_kelas']);
Route::post('/tambah-kelas', [KelasController::class, 'tambah_kelas']);

Route::get('/ubah-kelas/{idkelas}', [KelasController::class, 'index_ubah_kelas'])
->name('ubah-kelas');
Route::patch('/ubah-kelas/{idkelas}', [KelasController::class, 'ubah_kelas'])
->name('ubah-kelas');

Route::delete('/hapus-kelas/{idkelas}', [KelasController::class, 'hapus_kelas']);

// Waktu
Route::get('/mengelola-waktu', [WaktuController::class, 'index_mengelola_waktu']);

Route::get('/tambah-waktu', [WaktuController::class, 'index_tambah_waktu']);
Route::post('/tambah-waktu', [WaktuController::class, 'tambah_waktu']);

Route::get('/ubah-waktu/{idwaktu}', [WaktuController::class, 'index_ubah_waktu'])
->name('ubah-waktu');
Route::patch('/ubah-waktu/{idwaktu}', [WaktuController::class, 'ubah_waktu'])
->name('ubah-waktu');

Route::delete('/hapus-waktu/{idwaktu}', [WaktuController::class, 'hapus_waktu']);

// Dosen
Route::get('/mengelola-dosen', [DosenController::class, 'index_mengelola_dosen']);

Route::get('/tambah-dosen', [DosenController::class, 'index_tambah_dosen']);
Route::post('/tambah-dosen', [DosenController::class, 'tambah_dosen']);

Route::get('/ubah-dosen/{iddosen}', [DosenController::class, 'index_ubah_dosen'])
->name('ubah-dosen');
Route::patch('/ubah-dosen/{iddosen}', [DosenController::class, 'ubah_dosen'])
->name('ubah-dosen');

Route::delete('/hapus-dosen/{iddosen}', [DosenController::class, 'hapus_dosen']);

// Matkul
Route::get('/mengelola-matkul', [MatkulController::class, 'index_mengelola_matkul']);

Route::get('/tambah-matkul', [MatkulController::class, 'index_tambah_matkul']);
Route::post('/tambah-matkul', [MatkulController::class, 'tambah_matkul']);

Route::get('/ubah-matkul/{idmatkul}', [MatkulController::class, 'index_ubah_matkul'])
->name('ubah-matkul');
Route::patch('/ubah-matkul/{idmatkul}', [MatkulController::class, 'ubah_matkul'])
->name('ubah-matkul');

Route::delete('/hapus-matkul/{idmatkul}', [MatkulController::class, 'hapus_matkul']);