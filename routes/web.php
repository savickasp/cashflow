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
Route::prefix('/room')
    ->name('room.')
    ->group(function () {
        Route::get('/', 'RoomController@index')->name('index');
        Route::get('/create', 'RoomController@create')->name('create');
        Route::post('/create', 'RoomController@store')->name('store');
        Route::get('/{room}', 'RoomController@show')->name('show');
        Route::get('/{room}/edit', 'RoomController@edit')->name('edit');
        Route::post('/{room}/edit', 'RoomController@update')->name('update');
        Route::get('/{room}/delete', 'RoomController@destroy')->name('destroy');
        Route::post('/{room}/delete', 'RoomController@destroySave')->name('destroySave');
        Route::get('/{room}/join', 'RoomController@join')->name('join');
        Route::post('/{room}/join', 'RoomController@joinValidate')->name('joinValidate');
        Route::get('/{room}/kick/{user}', 'RoomController@kickPlayer')->name('kick');
        Route::post('/{room}/kick/{user}', 'RoomController@kickPlayerSave')->name('kickSave');
        Route::get('/{room}/makeadmin/{user}', 'RoomController@setAdmin')->name('setAdmin');
        Route::post('/{room}/makeadmin/{user}', 'RoomController@setAdminSave')->name('setAdminSave');
    });

Route::prefix('/game/{game}')
    ->name('game.')
    ->group(function () {
        Route::get('/', 'GameController@index')->name('index');
        Route::get('/check', 'GameController@check')->name('check');
        Route::get('/role', 'GameController@setRole')->name('role');
        Route::post('/role', 'GameController@saveRole')->name('roleSave');
    });
