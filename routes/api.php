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
Route::middleware('auth:api')
    ->prefix('user/{user}/game/{game}')
    ->group( function () {
        Route::get('/liability/all', 'Game\LiabilityController@getAll');
        Route::get('/asset/all', 'Game\AssetController@getAll');
        Route::put('/loan/repay', 'Game\LiabilityController@repayLoan');
        Route::put('/loan/take', 'Game\LiabilityController@takeLoan');
        Route::put('/stock/add', 'Game\AssetController@addAsset');
        Route::patch('/stock/sell', 'Game\AssetController@sellAsset');
        Route::put('/fond/add', 'Game\AssetController@addAsset');
        Route::patch('/fond/sell', 'Game\AssetController@sellAsset');
        Route::put('/nt/add', 'Game\AssetController@addAsset');
        Route::patch('/nt/sell', 'Game\AssetController@sellAsset');
        Route::patch('/child', 'Game\AssetController@addChild');
    });
