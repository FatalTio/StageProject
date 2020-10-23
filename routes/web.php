<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CscDatasourcesController;
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

Route::get('/init', 'AppController@init');

Route::get('/index', 'BlockchainController@index');

Route::get('/dontShow/{dontShow}', 'BlockchainController@dontShowGuide');


// POST for the form
Route::post('/dataSourceTests', 'DatasourceController@testCurlDatasources');

Route::post('/testDatasources', 'CscDatasourcesController@testAllDatasources')->name('testDatasources');

Route::post('/htmlTableView', 'CollectionController@htmlTableView');




Route::get('/functionsTest/{howToTest}', 'CscDatasourcesController@functionsTest')->name('functionsTest');

Route::get('/viewJson/{datasource}/{function}/{address}', 'CscDatasourcesController@viewJson');

Route::get('/dataSourceJson/{net}/{function}/{address}', 'DatasourceController@dataSourceJson')->name('dataSourceJson');



Route::get('/getNets/{blockchain}', 'BlockchainController@getNetsFromBlockchain');

Route::get('/getDatasource/{net}', 'BlockchainController@getDatasourcesFromNet');

Route::get('/toCollection/{net}/{address}/{function}', 'CollectionController@cscToCollection');

Route::get('/csCannonFunctions/{net}/{address}/{function}', function($net, $address, $function){
    return response()->json(
        CscDatasourcesController::calltoArray($net, $address, $function)
    );
});


// HTML Table view
Route::get('/factoryJson', [
    'uses'  => 'CollectionController@factoryToTableView',
    'as'    => 'factoryJson'
]);

Route::get('/dbToJson/{tableName}', 'CollectionController@dbToJson');

Route::get('/getWithPagination/{table}/{nbPerPage}/{pagination}', 'TableViewController@getWithPagination');

Route::get('/view/{table}', [
    'uses'  => 'CollectionController@tableAjax',
    'as'    => 'viewTable'
]);

Route::get('count/{table}', 'CollectionController@countDatas');

// TEST
Route::get('/createViewTable/{entity}', 'CollectionController@createViewTable');
