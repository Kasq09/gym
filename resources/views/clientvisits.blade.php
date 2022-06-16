<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sākums') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ url("/addclientvisit/" . request()->id )}}" class="btn btn-primary mb-3 ">Pievienot rezervāciju</a>



                    <input type="date" oninput="w3.filterHTML('#myTable', '.item', this.value)" class="form-control mb-3" placeholder="Meklēt rezervāciju">


                    <table class="table" id="myTable">
                        <thead class="thead-dark">
                        <tr>
                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(1)')"scope="col">Vārds</th>
                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(2)')"scope="col">Uzvārds</th>
                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(3)')"scope="col">Telefons</th>
                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(4)')"scope="col">Sākuma laiks</th>
                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(5)')"scope="col">Beigu laiks</th>
                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(6)')"scope="col">Treneris</th>
                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(7)')"scope="col">Telpa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($visits as $visit)

                            <tr class="item">
                                <td>{{$visit->client->name}}</td>
                                <td>{{$visit->client->surname}}</td>
                                <td>{{$visit->client->phone}}</td>
                                <td>{{$visit->start_time}}</td>
                                <td>{{$visit->end_time}}</td>
                                <td>{{$visit->user->name ?? 'Nav'}}</td>
                                <td>{{$visit->room->name}}</td>
                                <td><form action="{{route("dashboard.delete", $visit)}}"method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" >Izdzēst</button>
                                        <a href="{{ url('edit-visit/'.$visit->id) }}" class= "d-inline, btn btn-primary btn-sm">Rediģēt</a>
                                    </form></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{$visits->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
