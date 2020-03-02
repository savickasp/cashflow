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

// entry route
Route::get('/', 'FrontController@index')->name('front.index');

// user routes
Route::get('/user/{user}', 'UserController@index')->name('user.index');
Route::get('/profile/{user}', 'UserController@profile')->name('user.profile');

// room actions route
Route::prefix('/room')->group(function () {
    Route::get('/', 'RoomController@index')->name('room.index');
    Route::get('/create', 'RoomController@create')->name('room.create');
    Route::post('/create', 'RoomController@store')->name('room.store');
    Route::get('/{room}', 'RoomController@show')->name('room.show');
    Route::get('/{room}/edit', 'RoomController@edit')->name('room.edit');
    Route::post('/{room}/edit', 'RoomController@update')->name('room.update');
    Route::get('/{room}/delete', 'RoomController@destroy')->name('room.destroy');
    Route::post('/{room}/delete', 'RoomController@destroySave')->name('room.destroySave');
});
