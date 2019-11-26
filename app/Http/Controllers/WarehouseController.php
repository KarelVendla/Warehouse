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


        $warehouse = Warehouse::findOrFail($id)->first()->toArray();
        return new WarehouseResource($warehouse);
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

        $warehouse = Warehouse::find($id);
        $warehouse->name = $request->name;
        $warehouse->longitude = $request->longitude;
        $warehouse->latitude = $request->latitude;
        $warehouse->save();

        return new WarehouseResource($warehouse);
    }
}
