<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KadivController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KegiatanSubtaskController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');

Route::resources([
    'user' => UserController::class,
    'kegiatan' => KegiatanController::class,
    'subtask' => KegiatanSubtaskController::class,
    'dokumen' => DokumenController::class
]);

Route::get('administrator/manajemen_user', [UserController::class, 'home'])->name('user.manajemen');

Route::get('/user/{id}/ubah_password', [UserController::class, 'ubah_password'])->name('user.update_password');

Route::post('/user/ubah_password', [UserController::class, 'simpan_password'])->name('user.simpan_password');

Route::get('kegiatan/{id}/hapus_anggota', [KegiatanController::class, 'index'])->name('kegiatan.anggota');

Route::get('kegiatan/tandai_selesai/{id}', [KegiatanController::class, 'tandai_selesai'])->name('kegiatan.tandai_selesai');

Route::get('kegiatan/belum_selesai/{id}', [KegiatanController::class, 'belum_selesai'])->name('kegiatan.belum_selesai');

Route::get('cari', [KegiatanController::class, 'cari'])->name('kegiatan.cari');

Route::get('tanggal', [KegiatanController::class, 'cari_tanggal'])->name('kegiatan.cari_tanggal');

Route::post('kegiatan/{id}/tambah_anggota', [KegiatanController::class, 'tambah_anggota_proyek'])->name('kegiatan.tambah_anggota_proyek');

Route::get('kegiatan/{id}/hapus_anggota/{kode}', [KegiatanController::class, 'hapus_anggota_proyek'])->name('kegiatan.hapus_anggota');

Route::get('subtask/{id}/kerjakan', [KegiatanSubtaskController::class, 'kerjakan'])->name('subtask.kerjakan');

Route::get('subtask/{id}/pindah_kanan', [KegiatanSubtaskController::class, 'pindah_kanan'])->name('subtask.pindah_kanan');

Route::get('subtask/{id}/pindah_kiri', [KegiatanSubtaskController::class, 'pindah_kiri'])->name('subtask.pindah_kiri');

Route::get('subtask/{id}/destroy', [KegiatanSubtaskController::class, 'destroy'])->name('subtask.destroy');

Route::group(['middleware' => 'checkRole:1'], function () {
    Route::resource('administrator', AdministratorController::class);

    Route::get('/administrator/{id}/ubah_password', [AdministratorController::class, 'ubah_password'])->name('administrator.ubah_password');

    Route::post('user', [UserController::class, 'store'])->name('user.store');

    Route::get('administrator/user/{id}/show', [UserController::class, 'user_detail'])->name('user.detail');
});

Route::group(['middleware' => 'checkRole:2'], function () {
    Route::resource('kadiv', KadivController::class);

    Route::get('/kadiv/{id}/ubah_password', [KadivController::class, 'ubah_password'])->name('kadiv.ubah_password');
});

Route::group(['middleware' => 'checkRole:3'], function () {
    Route::resource('pegawai', PegawaiController::class);

    Route::get('/pegawai/{id}/ubah_password', [PegawaiController::class, 'ubah_password'])->name('pegawai.ubah_password');
});

Route::get('dokumen/{id}-{kode}/download', [DokumenController::class, 'download'])->name('dokumen.download');

Route::get('dokumen/{id}-{kode}/show', [DokumenController::class, 'show'])->name('dokumen.show');

Route::get('dokumen/{id}-{kode}/destroy', [DokumenController::class, 'destroy'])->name('dokumen.destroy');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');