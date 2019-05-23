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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
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
});

Route::group(['prefix' => 'user'], function() {
	Route::get('show', 'UserController@show_admin');
	Route::post('add-admin', 'UserController@store_admin');
});