<?php

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

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');

Route::resource('user', 'UserController');

Route::get('administrator/manajemen_user', [
    'as' => 'user.manajemen',
    'uses' => 'UserController@home'
]);

Route::get('/user/{id}/ubah_password', [
    'as' => 'user.update_password',
    'uses' => 'UserController@ubah_password'
]);

Route::post('/user/ubah_password', function(\Illuminate\Http\Request $request){})->name('user.simpan_password')->uses('UserController@simpan_password');

Route::resource('kegiatan', 'KegiatanController');

Route::get('kegiatan/{id}/hapus_anggota', [
    'as' => 'kegiatan.anggota',
    'uses' => 'KegiatanController@anggota_proyek'
]);

Route::get('kegiatan/tandai_selesai/{id}', [
    'as' => 'kegiatan.tandai_selesai',
    'uses' => 'KegiatanController@tandai_selesai'
]);

Route::get('kegiatan/belum_selesai/{id}', [
    'as' => 'kegiatan.belum_selesai',
    'uses' => 'KegiatanController@belum_selesai'
]);

Route::get('cari', [
    'as' => 'kegiatan.cari',
    'uses' => 'KegiatanController@cari'
]);

Route::get('tanggal', [
    'as' => 'kegiatan.cari_tanggal',
    'uses' => 'KegiatanController@cari_tanggal'
]);

Route::post('kegiatan/{id}/tambah_anggota', function(\Illuminate\Http\Request $request){})->name('kegiatan.tambah_anggota_proyek')->uses('KegiatanController@tambah_anggota_proyek');

Route::get('kegiatan/{id}/hapus_anggota/{kode}')->name('kegiatan.hapus_anggota')->uses('KegiatanController@hapus_anggota_proyek');

Route::resource('subtask', 'KegiatanSubtaskController');

Route::get('subtask/{id}/kerjakan', [
    'as' => 'subtask.kerjakan',
    'uses' => 'KegiatanSubtaskController@kerjakan'
]);

Route::get('subtask/{id}/pindah_kanan', [
    'as' => 'subtask.pindah_kanan',
    'uses' => 'KegiatanSubtaskController@pindah_kanan'
]);

Route::get('subtask/{id}/pindah_kiri', [
    'as' => 'subtask.pindah_kiri',
    'uses' => 'KegiatanSubtaskController@pindah_kiri'
]);

Route::get('subtask/{id}/destroy', [
    'as' => 'subtask.destroy',
    'uses' => 'KegiatanSubtaskController@destroy'
]);

Route::group(['middleware' => 'checkRole:1'], function () {
    Route::resource('administrator', 'AdministratorController');

    Route::get('/administrator/{id}/ubah_password', [
        'as' => 'administrator.ubah_password',
        'uses' => 'AdministratorController@ubah_password'
    ]);

    Route::get('user/create', [
        'as' => 'user.create',
        'uses' => 'UserController@create'
    ]);

    Route::post('user', [
        'as' => 'user.store',
        'uses' => 'UserController@store'
    ]);

    Route::get('administrator/user/{id}/show', [
        'as' => 'user.detail',
        'uses' => 'UserController@user_detail'
    ]);
});

Route::group(['middleware' => 'checkRole:2'], function () {
    Route::resource('kadiv', 'KadivController');

    Route::get('/kadiv/{id}/ubah_password', [
        'as' => 'kadiv.ubah_password',
        'uses' => 'KadivController@ubah_password'
    ]);
});

Route::group(['middleware' => 'checkRole:3'], function () {
    Route::resource('pegawai', 'PegawaiController');

    Route::get('/pegawai/{id}/ubah_password', [
        'as' => 'pegawai.ubah_password',
        'uses' => 'PegawaiController@ubah_password'
    ]);
});

Route::resource('dokumen', 'DokumenController');

Route::get('dokumen/{id}-{kode}/download', [
    'as' => 'dokumen.download',
    'uses' => 'DokumenController@download'
]);

Route::get('dokumen/{id}-{kode}/show', [
    'as' => 'dokumen.show',
    'uses' => 'DokumenController@show'
]);

Route::get('dokumen/{id}-{kode}/destroy', [
    'as' => 'dokumen.destroy',
    'uses' => 'DokumenController@destroy'
]);



