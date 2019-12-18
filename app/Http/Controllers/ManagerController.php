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

    //Update managers coordinates
    public function update(Request $request) {

        $manager = Manager::find(1);

        if ($manager == null) {
            
            $manager = new Manager();
            $manager->id = 1;
            $manager->longitude = $request->filled('longitude') ? $request->input('longitude', $manager->longitude) : $manager->longitude;
            $manager->latitude = $request->filled('latitude') ? $request->input('latitude', $manager->latitude) : $manager->latitude;
            $manager->save();

        } else {
            $manager->longitude = $request->filled('longitude') ? $request->input('longitude', $manager->longitude) : $manager->longitude;
            $manager->latitude = $request->filled('latitude') ? $request->input('latitude', $manager->latitude) : $manager->latitude;
            $manager->save();
        }

        return new ManagerResource($manager);
    }

    
    
}
