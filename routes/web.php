<?php

use App\Http\Controllers\BlockchainController;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', function () {
    return view('welcome');
});

Route::get('/init', 'AppController@init');

Route::get('/blockchain/{blockchainId}', 'BlockchainController@getBlockchainsSources');

Route::get('/cscFunctions', 'BlockchainController@cscFunctionstest')->name('cscFunctions');

Route::get('/index', 'BlockchainController@index');

Route::post('/testDatasources', 'CscDatasourcesController@testAllDatasources')->name('testDatasources');