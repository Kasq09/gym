<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Room;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index(Request $request){
        $filter = $request->input('filter');
        if(!empty($filter)) {
            if (auth()->user()->role == 'admin') {
                return view("dashboard", [
                    "visits"=> Visit::with(["client","room", "user"])
                        ->where('start_time','like', '%'.$filter.'%')
                        ->orWhereRelation('client','name','like', '%'.$filter.'%')
                        ->orWhereRelation('client','surname','like', '%'.$filter.'%')
                        ->orWhereRelation('user','name','like', '%'.$filter.'%')
                        ->orWhereRelation('room','name','like', '%'.$filter.'%')
                        ->sortable()->paginate(15),
                    "filter" => $filter
                ]);
            } else {
                return view("dashboard", [
                    "visits"=> auth()->user()->visits()->with(["client","room", "user"])
                        ->where('start_time','like', '%'.$filter.'%')
                        ->orWhereRelation('client','name','like', '%'.$filter.'%')
                        ->orWhereRelation('client','surname','like', '%'.$filter.'%')
                        ->orWhereRelation('user','name','like', '%'.$filter.'%')
                        ->orWhereRelation('room','name','like', '%'.$filter.'%')
                        ->paginate(15),
                    "filter" => $filter

                ]);
            }
        } else {
            if (auth()->user()->role == 'admin') {
                return view("dashboard", [
                    "visits"=> Visit::with(["client","room", "user"])
                        ->sortable()->paginate(15),
                    'filter' => ''
                ]);
            } else {
                return view("dashboard", [
                    "visits"=> auth()->user()->visits()->with(["client","room", "user"])
                        ->paginate(15),
                    'filter' => ''

                ]);
            }
        }



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
        $clients = Client::orderBy('surname')->get();
        $rooms =Room::all();
        $visit =Visit::find($id);
        $coaches = User::where('role', '=', 'coach')->get();
        return view('editvisit', compact(['visit','rooms', 'clients', 'coaches']));
    }

    public function update(Request $request, $id)
    {
        $visit = Visit::find($id);
        $visit->client_id = $request->input('client_id');
        $visit->start_time = $request->input('start_time');
        $visit->user_id = $request->input('user_id');
        $visit->end_time = $request->input('end_time');
        $visit->room_id = $request->input('room_id');

        $visit->update();
        return redirect("/dashboard");
    }

    public function printvisits(Request $request)
    {
        if(auth()->user()->role == 'admin')
        {
        return view("printvisits", [
                "visits"=> Visit::with(["client","room", "user"])->where("start_time","LIKE", $request->input("filter"). '%')->get()
        ]);
        } else {
            return view("printvisits", [
                "visits"=> auth()->user()->visits()->with(["client","room", "user"])->where("start_time","LIKE", $request->input("filter"). '%')->get()
            ]);
        }
    }

}

