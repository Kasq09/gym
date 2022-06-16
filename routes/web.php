<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\VisitController;
use App\Models\Client;
use App\Models\Coach;
use App\Models\Room;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [VisitController::class, "index"])->middleware(['auth'])->name('dashboard');
Route::delete('/dashboard/{visit}', [VisitController::class, "delete"])->middleware(['auth'])->name('dashboard.delete');;

Route::get('/clients', [ClientController::class, "index"])->middleware(['auth'])->name('clients');
Route::delete('/clients/{client}', [ClientController::class, "delete"])->middleware(['auth'])->name('clients.delete');
Route::get('/edit-client/{id}', [ClientController::class, "edit"]);
Route::put('update-client/{id}', [ClientController::class, "update"]);


Route::post('/addclient', [ClientController::class, "store"])->middleware(['auth'])->name('addclient');
Route::view('/addclient', 'addclient')->middleware(['auth'])->name('addclient');;

Route::get('/rooms', [RoomController::class, "index"])->middleware(['auth'])->name('rooms');
Route::delete('/rooms/{room}', [RoomController::class, "delete"])->middleware(['auth'])->name('rooms.delete');
Route::get('/edit-room/{id}', [RoomController::class, "edit"]);
Route::put('update-room/{id}', [RoomController::class, "update"]);


Route::post('/addroom', [RoomController::class, "store"])->middleware(['auth'])->name('addroom');
Route::view('/addroom', 'addroom')->middleware(['auth'])->name('addroom');;

Route::view('/addvisit', 'addvisit',
    ["clients"=>Client::orderBy('surname')->get(),
        "rooms"=>Room::all(),
        "coaches"=>User::where('role', '=', 'coach')->get()
    ])->middleware(['auth'])->name('addvisit');;

Route::post('/addvisit', [VisitController::class, "store"])->middleware(['auth'])->name('addvisit');
Route::get('/edit-visit/{id}', [VisitController::class, "edit"]);
Route::put('update-visit/{id}', [VisitController::class, "update"]);

Route::get('/clientvisits/{id}', function ($id) {
    return view('clientvisits', [
        "visits"=> Visit::where("client_id", $id)->with(["client","room"])->paginate(10)
    ]);

});

Route::get('/printvisits', [VisitController::class, "printvisits"])->middleware(['auth'])->name('printvisits');



Route::get('/addclientvisit/{id}', function ($id) {
    return view('addclientvisit', [
        "clients" => Client::where('id', '=' , $id)->get(),
        "rooms"=> Room::all(),
        "coaches"=> User::where('role', '=', 'coach')->get()
    ]);

});

require __DIR__.'/auth.php';
