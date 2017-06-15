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

Route::get('/', 'DashboardController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'DashboardController@index');
    
    Route::group(['prefix' => 'peta/ajax'], function () {
		Route::get('rumah', 'MapsController@ajax_rumah');    
	});

	Route::get('peta', 'MapsController@index');
	Route::resource('user', 'UserController');
	Route::resource('pekerjaan', 'PekerjaanController');

	//pengajuan rtlh
	Route::resource('pengajuan', 'PengajuanController');
	Route::resource('pengajuan/{idrtlh}/fotortlh', 'PengajuanFotoController', ['except' => [
	    'index', 'show'
	]]);

	//admin rtlh
	Route::resource('rtlh', 'RtlhController');
	Route::resource('rtlh/{idrtlh}/fotortlh', 'FotoRtlhController', ['except' => [
	    'index', 'show'
	]]);

	Route::get('verifikasi', 'VerifikasiController@index');
	Route::get('verifikasi/{id}', 'VerifikasiController@detail');
	Route::put('verifikasi/{id}', 'VerifikasiController@verifikasi');
	Route::get('terverifikasi', 'VerifikasiController@sudah');
	Route::get('terverifikasi/{id}', 'VerifikasiController@detailsudah');

	Route::resource('terverifikasi/{idrtlh}/penanganan', 'PenangananController');

	Route::get('rekap', 'PenangananController@rekap');
});

Auth::routes();
