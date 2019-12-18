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

//List warehouses/rooms, get managers coordinates
Route::get('rooms', 'RoomsController@index');
Route::get('warehouses', 'WarehouseController@index');
Route::get('managers','ManagerController@index');

//Get warehouse by id
Route::get('warehouses/{id}','WarehouseController@show');
Route::get('rooms/{warehouseid}', 'RoomsController@show');

// Create new warehouse/room
Route::post('room', 'RoomsController@store');
Route::post('warehouse','WarehouseController@store');

//Get Manager data and Warehous data
Route::post('openmaps/{warehouseid}', 'Controller@getOpenMapsData');

//Update warehouse/manager
Route::put('warehouse/{id}','WarehouseController@update');
Route::put('manager', 'ManagerController@update');
Route::put('room', 'RoomsController@update');

//Delete warehouse/room
Route::delete('room/{id}', 'RoomsController@destroy');