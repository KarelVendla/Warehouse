<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Manager as ManagerResource;
use App\Manager;

class ManagerController extends Controller
{
    
    //Get manager coordinates
    public function index() {

        //Get warehouses
       $managers = Manager::all();

       // Return collection of warehouses as a resource
       return ManagerResource::collection($managers);
    }

    //Update warehouse
    public function update(Request $request, $id) {

        $manager = Warehouse::findOrFail($id);
        $manager->longitude = $request->input('mlng');
        $manager->latitude = $request->input('mlat');
        
        if ($manager->save()) {
            return new WarehouseResource($manager);
        }
    }

    
    
}
