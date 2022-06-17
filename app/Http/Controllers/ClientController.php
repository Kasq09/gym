<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request){
        $filter = $request->input('filter');
        return view("clients", [
            "clients"=> Client::
                where('name','like', '%'.$filter.'%')
                ->orWhere('surname','like', '%'.$filter.'%')
                ->orWhere('phone','like', '%'.$filter.'%')
                ->paginate(20),
            "filter" => $filter
        ]);
    }






    public function store(Request $request){
        Client::create($request->all());
        return redirect("/clients");
    }

    public function delete(Client $client){

        $client->delete();
        return back();
    }


    public function edit($id)
    {
        $client = Client::find($id);
        return view('editclient', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $visit = Client::find($id);
        $visit->name = $request->input('name');
        $visit->surname = $request->input('surname');
        $visit->phone = $request->input('phone');

        $visit->update();
        return redirect("/clients");
    }
}
