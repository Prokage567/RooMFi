<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Index of all the rooms
     * Get:/api/room
     * @return JsonResponse|mixed
     */
    public function all(){
        return $this->ok(Room::all(),"all Rooms!");
    }

    /**
     * Shows a room by id 
     * Get:/api/room
     * @param \App\Models\Room $room
     * @return JsonResponse|mixed
     */
    public function show(Room $room,Request $request){
        return $this->ok($room, "Room name!");
    }    
    
    /**
     * Creates new data to update
     * POST: /api/room 
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse|mixed
     */
    public function store(Request $request){
        if ($request->user()->role_id != "admin") {
            return $this->Forbidden("you are not an Admin!");
        }
        $validator = validator($request -> all(),[
            "name" => "required|String",
            "category_id" => "required|exists:categories,id"
        ]);
        if($validator->fails()){
            return $this->BadRequest($validator,"Invalid input!");
        };

        $validated = $validator->validated();

        $room = Room::create($validated);

        return $this->ok($room,"Room Created!");    
    }

    /**
     * Updates the data by ID
     * patch: /api/room/{room}
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Room $room
     * @return JsonResponse|mixed
     */
    public function update(Request $request,Room $room){
        if ($request->user()->role_id != "admin") {
            return $this->Forbidden("you are not an Admin!");
        }
        $validator = validator($request -> all(),[
            "name" => "required|String",
            "category_id" => "required|exists:categories,id"
        ]);
        if($validator->fails()){
            return $this->BadRequest($validator,"Invalid input!");
        };

        $validated = $validator->validated();

        $room->update($validated);
        
        return $this->ok($validated,"Room has been updated!");
    }

    /**
     * Deletes room by ID
     * delete:api/room/{room}
     * @param \App\Models\Room $room
     * @return JsonResponse|mixed
     */
    public function delete(Room $room, Request $request){
        if ($request->user()->role_id != "admin") {
            return $this->Forbidden("you are not an Admin!");
        }
        $room->delete();
        return $this->ok(null,"Room has been deleted!");
    }
}
//done by Clare