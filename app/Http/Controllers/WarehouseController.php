<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\warehouse;
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


    //Add new warehouse
    public function store(Request $request) { 

        $warehouse = new Warehouse;

        $warehouse->name = $request->input('name');
        $warehouse->longitude = $request->input('longitude');
        $warehouse->latitude = $request->input('latitude');
        $warehouse->status = $request->input('status');

        if ($warehouse->save()) {
            return new WarehouseResource($warehouse);
        }
    
    }


    //Update warehouse
    public function update(Request $request, $id) {

        $warehouse = Warehouse::findOrFail($id);
        $warehouse->name = $request->input('wname');
        $warehouse->longitude = $request->input('wlng');
        $warehouse->latitude = $request->input('wlat');
        
        if ($warehouse->save()) {
            return new WarehouseResource($warehouse);
        }
    }
}
