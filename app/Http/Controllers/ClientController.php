<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return view("clients", [
            "clients"=> Client::paginate(10)
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
