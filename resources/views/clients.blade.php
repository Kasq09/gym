<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Klienti') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{route("addclient")}}" class="btn btn-primary">Pievienot klientu</a>

                @foreach($clients as $client)

                    @endforeach
                    <table class="table" id="myTable">
                        <thead class="thead-dark">
                        <tr>

                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(1)')" scope="col">Vārds</th>
                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(2)')" scope="col">Uzvārds</th>
                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(3)')" scope="col">Telefons</th>
                            <th style="width: 150px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)

                            <tr class="item ">
                                <td>{{$client->name}}</td>
                                <td>{{$client->surname}}</td>
                                <td>{{$client->phone}}</td>
                                <td class="text-end"><form action="{{route("clients.delete", $client)}}"method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="d-inline, btn btn-danger btn-sm" type="submit" >Izdzēst</button>
                                        <a href="{{ url('edit-client/'.$client->id) }}" class= "d-inline, btn btn-primary btn-sm">Rediģēt</a>
                                    </form>
                                    </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{$clients->links()}}
                </div>
            </div>
        </div>
    </div>
    </x-app-layout>


