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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');

Route::resource('user', 'UserController');

Route::get('/user/{id}/ubah_password', [
    'as' => 'user.update_password',
    'uses' => 'UserController@ubah_password'
]);

Route::post('/user/ubah_password', function(\Illuminate\Http\Request $request){})->name('user.simpan_password')->uses('UserController@simpan_password');

Route::resource('proyek', 'ProyekController');

//Route::get('/proyek_progress/{id}-kode={kode?}/edit', [
//    'as' => 'proyek_progress.edit',
//    'uses' => 'ProyekProgressController@edit'
//]);

Route::get('proyek/{id}/hapus_anggota', [
    'as' => 'proyek.anggota',
    'uses' => 'ProyekController@anggota_proyek'
]);

Route::get('proyek/{id}/tambah_anggota', [
    'as' => 'proyek.tambah_anggota',
    'uses' => 'ProyekController@tambah_anggota'
]);

Route::get('proyek/tandai_selesai/{id}', [
    'as' => 'proyek.tandai_selesai',
    'uses' => 'ProyekController@tandai_selesai'
]);

Route::get('proyek/belum_selesai/{id}', [
    'as' => 'proyek.belum_selesai',
    'uses' => 'ProyekController@belum_selesai'
]);

Route::post('proyek/{id}/tambah_anggota', function(\Illuminate\Http\Request $request){})->name('proyek.tambah_anggota_proyek')->uses('ProyekController@tambah_anggota_proyek');

Route::post('proyek/{id}/hapus_anggota', function(\Illuminate\Http\Request $request) {})->name('proyek.hapus_anggota')->uses('ProyekController@hapus_anggota_proyek');

Route::resource('proyek_progress', 'ProyekProgressController');

Route::get('proyek_progress/{id}/create', [
    'as' => 'proyek_progress.create',
    'uses' => 'ProyekProgressController@create'
]);

Route::get('proyek_progress/{id}/destroy', [
    'as' => 'proyek_progress.destroy',
    'uses' => 'ProyekProgressController@destroy'
]);

Route::group(['middleware' => 'checkRole:1'], function () {
    Route::resource('administrator', 'AdministratorController');

    Route::get('/administrator/{id}/ubah_password', [
        'as' => 'administrator.ubah_password',
        'uses' => 'AdministratorController@ubah_password'
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


