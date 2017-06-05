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

Route::group(['prefix' => 'peta/ajax'], function () {
	Route::get('rumah', 'MapsController@ajax_rumah');    
});

Route::get('peta', 'MapsController@index');
Route::resource('user', 'UserController');
Route::resource('pekerjaan', 'PekerjaanController');
Route::resource('rtlh', 'RtlhController');
Route::resource('rtlh/{idrtlh}/fotortlh', 'FotoRtlhController', ['except' => [
    'index', 'show'
]]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
