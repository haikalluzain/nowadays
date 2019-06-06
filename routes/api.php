<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api', 'prefix' => 'user'], function () {
	Route::post('show', 'Api\Auth\UserController@show');
});

Route::group(['prefix' => 'user'], function () {
	Route::post('login', 'Api\Auth\UserController@login');
	Route::post('register', 'Api\Auth\UserController@register');
	Route::post('logout', 'Api\Auth\UserController@logout');
});

Route::group(['prefix' => 'event'], function() {
	Route::get('show', 'EventController@show');
	Route::post('insert', 'EventController@store');
    Route::post('update', 'EventController@update');
    Route::delete('delete/{id}', 'EventController@destroy');
});

Route::group(['prefix' => 'today'], function() {
	Route::get('all', 'TodayController@index');
	Route::get('show', 'TodayController@show');
	Route::post('insert', 'TodayController@store');
    Route::post('update', 'TodayController@update');
    Route::delete('delete/{id}', 'TodayController@destroy');
	Route::get('what', 'TodayController@what');
});

// Route::group(['prefix' => 'user'], function() {
// 	Route::get('show', 'UserController@show_admin');
// 	Route::post('add-admin', 'UserController@store_admin');
// });

Route::post('rombel/check','RombelController@rombel');