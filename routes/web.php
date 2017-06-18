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

Route::get('/', 'FEController@index');
Route::get('/kontak', 'FEController@kontak');
Route::get('/rtlh', 'FEController@rtlh');
Route::get('/rtlh/{id}', 'FEController@detail');
Route::get('/program', 'FEController@program');
Route::get('/lokasi', 'FEController@lokasi');
Route::group(['prefix' => 'ajax'], function () {
	Route::get('rumah', 'FEController@ajax_rumah');    
});

Route::group(['prefix' => 'superadmin', 'middleware' => ['auth', 'superadmin']], function () {
	Route::get('/', 'DashboardController@indexsuperadmin');
	Route::resource('user', 'UserController');
	Route::resource('pekerjaan', 'PekerjaanController');
	
	//rtlh
	Route::resource('rtlh', 'RtlhController');
	Route::resource('rtlh/{idrtlh}/fotortlh', 'FotoRtlhController', ['except' => [
	    'index', 'show'
	]]);

	//program
	Route::get('program', 'PenangananController@rekapsuperadmin');

	//peta
	Route::get('lokasi', 'MapsController@indexsuperadmin');
	Route::group(['prefix' => 'ajax'], function () {
		Route::get('rumah', 'MapsController@ajax_rumah_superadmin');    
	});
});

Route::group(['prefix' => 'adminperbekel', 'middleware' => ['auth', 'adminperbekel']], function () {
	Route::get('/', 'DashboardController@indexperbekel');

	Route::get('/rtlh', 'RtlhController@indexperbekel');
	Route::get('/rtlh/{id}', 'RtlhController@detailperbekel');	

	Route::resource('pengajuan', 'PengajuanController');
	Route::resource('pengajuan/{idrtlh}/fotortlh', 'PengajuanFotoController', ['except' => [
	    'index', 'show'
	]]);

	Route::get('/penanganan', 'PenangananController@rekapperbekel');

	//peta
	Route::get('lokasi', 'MapsController@indexperbekel');
	Route::group(['prefix' => 'ajax'], function () {
		Route::get('rumah', 'MapsController@ajax_rumah_perbekel');    
	});
});

Route::group(['prefix' => 'adminverifikasi', 'middleware' => ['auth', 'adminverifikasi']], function () {
	Route::get('/', 'DashboardController@indexverifikasi');

	Route::get('verifikasi', 'VerifikasiController@index');
	Route::get('verifikasi/{id}', 'VerifikasiController@detail');
	Route::get('verifikasi/{id}/crosscheck', 'VerifikasiController@crosscheck');
	Route::put('verifikasi/{id}/verify', 'VerifikasiController@verifikasi');
	Route::get('terverifikasi', 'VerifikasiController@sudah');
	Route::get('terverifikasi/{id}', 'VerifikasiController@detailsudah');

	//peta
	Route::get('lokasi', 'MapsController@indexverifikasi');
	Route::group(['prefix' => 'ajax'], function () {
		Route::get('rumah', 'MapsController@ajax_rumah_verifikasi');    
	});
});




Route::group(['prefix' => 'adminkepala', 'middleware' => ['auth', 'adminkepala']], function () {
	Route::get('/', 'DashboardController@indexkepala');

	Route::get('/rtlh', 'RtlhController@indexkepala');
	Route::get('/rtlh/{id}', 'RtlhController@detailkepala');

	//penanganan
	Route::get('/rtlh/{id}/program', 'PenangananController@editkepala');
	Route::put('/rtlh/{id}/program', 'PenangananController@updatekepala');
	Route::put('/rtlh/{id}/publish', 'PenangananController@publishkepala');

	Route::get('/program', 'PenangananController@rekapkepala');

	//peta
	Route::get('lokasi', 'MapsController@indexkepala');
	Route::group(['prefix' => 'ajax'], function () {
		Route::get('rumah', 'MapsController@ajax_rumah_kepala');    
	});
});

Auth::routes();
Route::post('/ajax/faktaintegritas', 'AjaxController@faktaintegritas');
