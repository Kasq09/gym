<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function index(){
        return view("rooms", [
            "rooms"=> Room::all()
        ]);
    }
    public function store(Request $request){
        Room::create($request->all());
        return redirect("/rooms");
    }

    public function delete(Room $room){

        $room->delete();
        return back();
    }


    public function edit($id)
    {
        $room = Room::find($id);
        return view('editroom', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $visit = Room::find($id);
        $visit->name = $request->input('name');
        $visit->description = $request->input('description');

        $visit->update();
        return redirect("/rooms");
    }

}
