<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Room;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index(){
        return view("dashboard", [
            "visits"=> Visit::with(["client","room", "employee"])->paginate(10)

        ]);
    }
    public function delete(Visit $visit){

        $visit->delete();
        return back();

    }

    public function store(Request $request){
        Visit::create($request->all());
        return redirect("/dashboard");
    }

    public function edit($id)
    {
        $clients =Client::all();
        $rooms =Room::all();
        $visit =Visit::find($id);
        return view('editvisit', compact(['visit','rooms', 'clients']));
    }

    public function update(Request $request, $id)
    {
        $visit = Visit::find($id);
        $visit->start_time = $request->input('start_time');
        $visit->end_time = $request->input('end_time');
        $visit->room_id = $request->input('room_id');

        $visit->update();
        return redirect("/dashboard");
    }
}
