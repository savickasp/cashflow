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

// user authentication routes
Auth::routes();

// user routes
Route::get('/', 'FrontController@index')->name('front.index');
Route::get('/user/{user}', 'UserController@index')->name('user.index');

// room actions route
Route::get('/rooms', 'RoomController@index')->name('room.index');
Route::get('/room/create', 'RoomController@create')->name('room.create');
Route::post('/room/create', 'RoomController@store')->name('room.store');
Route::get('/room/{room}', 'RoomController@show')->name('room.show');
Route::get('/room/{room}/edit', 'RoomController@edit')->name('room.edit');
Route::post('/room/{room}/edit', 'RoomController@update')->name('room.update');
Route::get('/room/{room}/delete', 'RoomController@destroy')->name('room.destroy');
Route::post('/room/{room}/delete', 'RoomController@destroySave')->name('room.destroySave');
