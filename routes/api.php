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

// Create new warehouse/room
Route::post('room', 'RoomsController@store');
Route::post('warehouse','WarehouseController@store');

//Update warehouse/manager
Route::put('manager/{id}', 'ManagerController@update');
Route::put('warehouse/{id}','WarehouseController@update');

//Delete warehouse/room
Route::delete('room/{id}', 'RoomsController@destroy');