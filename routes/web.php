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

Route::get('/', 'HomeController@index');
Route::get('ganti/password', 'HomeController@gantiPasswordPage')->name('password.change');
Route::put('update/password', 'HomeController@gantiPassword')->name('password.ganti');

Auth::routes();

Route::group(['prefix' => 'grup'], function () {
    Route::get('create', 'GrupHadrohController@create')->name('grup.create');
    Route::post('store', 'GrupHadrohController@store')->name('grup.store');
    Route::get('show', 'GrupHadrohController@show')->name('grup.show');
    Route::put('update', 'GrupHadrohController@update')->name('grup.update');
});

Route::group(['prefix' => 'anggota'], function () {
    Route::get('create', 'GrupHadrohController@createAnggota')->name('anggota.create');
    Route::post('store', 'GrupHadrohController@storeAnggota')->name('anggota.store');
    Route::get('edit/{id}', 'GrupHadrohController@editAnggota')->name('anggota.edit');
    Route::put('update', 'GrupHadrohController@updateAnggota')->name('anggota.update');
});
Route::group(['prefix' => 'lomba'], function () {
    Route::get('create', 'LombaController@create')->name('lomba.create');
    Route::post('store', 'LombaController@store')->name('lomba.store');
    Route::get('ready/{id}', 'LombaController@readyPlay')->name('lomba.ready');
    Route::get('play/{id}', 'LombaController@grupPlay')->name('lomba.play');
    Route::get('stop/{id}', 'LombaController@grupStop')->name('lomba.stop');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-grup', 'HomeController@getGrup');
Route::get('pembayaran-page/{id}', 'LombaController@gotoPembayaranPage')->name('pembayaran.create');
Route::post('pembayaran/store', 'LombaController@storePembayaran')->name('pembayaran.store');
Route::get('make-sqlite', 'LombaController@makeSQLite');
Route::get('pengaturan', 'LombaController@gotoPengaturanPage')->name('pengaturan.create');
Route::post('pengaturan/store', 'LombaController@storePengaturan')->name('pengaturan.store');

Route::put('nomor-urut', 'LombaController@nomorUrut');
Route::get('timer/{id}', 'PenilaianController@timer');

Route::group(['prefix' => 'penilaian'], function () {
    Route::get('list-grup', 'PenilaianController@index')->name('penilaian.listgrup');
    Route::get('list-peserta', 'PenilaianController@getGrup');
    Route::get('{jenis}/{id}', 'PenilaianController@create');
    Route::get('timer-calculation/{id}/{pengurangan}', 'PenilaianController@timerCalculation');
});