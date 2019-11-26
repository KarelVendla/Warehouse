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

        $room->name = $request->name;
        $room->temperature = rand(21, 125);
        $room->warehouseid = $request->warehouseid;
        $room->save();
        return new RoomResource($room);
    
    }

    public function show($warehouseid) {
        $warehouseRooms = rooms::all()->where('warehouseid', $warehouseid);
        //return new RoomResource($warehouseRooms);
        return RoomResource::collection($warehouseRooms);
    }
    
}
