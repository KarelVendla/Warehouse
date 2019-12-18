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

        $room->forceDelete();
        return new RoomResource($room);

    }

    //Add new room
    public function store(Request $request) { 

        $room = new rooms;

        $room->name = "";
        $room->temperature = 0;
        $room->warehouseid = $request->warehouseid;
        $room->save();
        return new RoomResource($room);
    
    }

     //Update room
     public function update(Request $request) {

        
        $rooms = $request->all();
        foreach ($rooms as $roomData) {
            $room = rooms::findOrFail($roomData['id']);
            $room->name = isset($roomData['name']) ? $roomData['name'] : $room->name;
            $room->temperature = isset($roomData['temperature']) ? $roomData['temperature'] : $room->temperature;
            $room->save();
        }
        
        return ['status'=> 'done'];
    }

    public function show($warehouseid) {
        $warehouseRooms = rooms::all()->where('warehouseid', $warehouseid);
        //return new RoomResource($warehouseRooms);
        return RoomResource::collection($warehouseRooms);
    }
    
}
