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
    public function update(Request $request) {

        $manager = Manager::find(1);

        $this->validate($request, [
            'longitude' => 'required',
            'latitude' => 'required'
        ]);

        if ($manager == null) {
            
            $manager = new Manager();
            $manager->id = 1;
            $manager->longitude = $request->longitude;
            $manager->latitude = $request->latitude;
            $manager->save();

        } else {
            $manager->longitude = $request -> longitude;
            $manager->latitude = $request -> latitude;
            $manager->save();
        }

        

        return new ManagerResource($manager);
    }

    
    
}
