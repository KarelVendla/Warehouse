<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\rooms;
use App\Http\Resources\Room as RoomResource;

class RoomsController extends Controller
{
    //List all rooms
    public function index() {

        //Get rooms
       $rooms = rooms::all();

       // Return collection of rooms as a resource
       return RoomResource::collection($rooms);
    }

    //Delete room
    public function destroy($id) {

        //Get room
        $room = rooms::findOrFail($id);

        
        if ($room->delete()) {
            return new RoomResource($room);
        }
    }

    //Add new room
    public function store(Request $request) { 

        $room = new rooms;

        $room->name = $request->input('name');
        $room->temperature = $request->input('temperature');

        if ($room->save()) {
            return new WarehouseResource($room);
        }
    
    }

    
}
