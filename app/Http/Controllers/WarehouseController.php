<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\warehouse;
use App\rooms;
use App\Http\Resources\Warehouse as WarehouseResource;



class WarehouseController extends Controller
{
    //List all warehouses
    public function index() {

        //Get warehouses
       $warehouses = warehouse::all();

       // Return collection of warehouses as a resource
       return WarehouseResource::collection($warehouses);
    }

    public function show(Warehouse $id) {


        $warehouse = warehouse::all()->where('id', $id);
        //return new RoomResource($warehouseRooms);
        return WarehouseResource::collection($warehouse);
    }


    //Add new warehouse
    public function store(Request $request) { 

        $warehouse = new Warehouse();
        $warehouse->name = $request->name;
        $warehouse->longitude = $request->longitude;
        $warehouse->latitude = $request->latitude;
        $warehouse->status = '-';

        if ($warehouse->save()) {
            return new WarehouseResource($warehouse);
        }
    
    }


    //Update warehouse
    public function update(Request $request, $id) {

        $warehouse = Warehouse::findOrFail($id);
        $warehouse->name = $request->filled('name') ? $request->input('name', $warehouse->name) : $warehouse->name;
        $warehouse->longitude = $request->filled('longitude') ? $request->input('longitude', $warehouse->longitude) : $warehouse->longitude;
        $warehouse->latitude = $request->filled('latitude') ? $request->input('latitude', $warehouse->latitude) : $warehouse->latitude;
        $warehouse->status = $request->input('status', $warehouse->status);
        $warehouse->save();

        return new WarehouseResource($warehouse);
    }
}
