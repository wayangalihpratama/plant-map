<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Plant Map Route
Route::get('locations', 'api\LocationController@index'); 
Route::get('areas', 'api\AreaController@index'); 
Route::get('types', 'api\TypeController@index'); 
Route::get('trees', 'api\TreeController@index'); 
Route::get('plantations', 'api\AreaTreeController@index'); 
Route::get('histories', 'api\CarbonHistoryController@index'); 
