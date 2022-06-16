<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Klienti') }}
        </h2>
    </x-slot>
    @if(Auth::user()->role == "admin")
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <a href="{{route("addclient")}}" class="btn btn-primary mb-3">Pievienot klientu</a>




                    <form method="GET">
                        @csrf
                        <input class="form-control mb-3" name="filter" placeholder="Meklēt" value="{{$filter}}">
                        <button class="btn btn-primary" type="submit" >Meklēt</button>


                    </form>

                        <div style="height:600px;overflow:auto;">
                    <table class="table table table-hover" id="myTable">
                        <thead class="thead-dark">
                        <tr>

                            <th scope="col" class="ps-5">@sortablelink('name', 'Vārds')</th>
                            <th scope="col" class="ps-5">@sortablelink('surname', 'Uzvārds')</th>
                            <th class="link-primary" scope="col">Telefons</th>
                            <th style="width: 150px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)

                            <tr class="item ">
                                <td ><a class="btn btn-link w-25" href="{{ url('/clientvisits/'.$client->id) }}">{{$client->name}}</a> </td>
                                <td>{{$client->surname}}</td>
                                <td>{{$client->phone}}</td>
                                <td class="text-end"><form action="{{route("clients.delete", $client)}}"method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="d-inline, btn btn-danger btn-sm" type="submit" onclick="return confirm('Vai vēlaties dzēst ierakstu?')" >Izdzēst</button>
                                        <a href="{{ url('edit-client/'.$client->id) }}" class= "d-inline, btn btn-primary btn-sm">Rediģēt</a>
                                    </form>
                                    </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    </div>
                    {{$clients->links()}}
                </div>
            </div>
        </div>
    </div>

    @else
        <h1 class="text-center">Jums nav piekļuves šai lapai</h1>
        @endif
    </x-app-layout>


