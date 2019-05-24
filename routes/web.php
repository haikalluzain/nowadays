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
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('dashboard/fullscreen', 'DashboardController@tv')->name('dashboard.full');
	Route::view('event/calendar', 'content.event-calendar')->name('event.calendar');
	Route::view('today/list', 'content.today')->name('today.list');
	Route::view('today/date', 'content.today-date')->name('today.date');
	Route::view('admin', 'content.admin')->name('admin');
	Route::view('gmail-user', 'content.gmail-user')->name('g-user');

	Route::get('thumbnail/setactive/{thumbnail}','ThumbnailController@setactive')->name('thumbnail.setactive');
	Route::get('thumbnail/active','ThumbnailController@active')->name('thumbnail.active');
	Route::get('thumbnail/inactive','ThumbnailController@inactive')->name('thumbnail.inactive');
	Route::resource('thumbnail','ThumbnailController');

	Route::get('attendance/all','AttendanceController@all')->name('attendance.all');

	Route::resources([
		'major'=>'MajorController',
		'rombel'=>'RombelController',
		'attendance'=>'AttendanceController'
	]);
});
