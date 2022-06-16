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
<div class="row">
    <div class="col-auto">
        @if(Auth::user()->role == "admin")

        <a href="{{route("addvisit")}}" class="btn btn-primary mb-3 ">Pievienot rezervāciju</a>

            @endif
    </div>

        <div class="col-auto">
            <form method="get" action="/printvisits">
                @csrf

                <input type="hidden" value="{{$filter}}" name="filter">

                <button type="submit" class="btn btn-primary d-inline mb-2">Printēt</button>


        </div>

</div>



                    </form>
                    <form class="form-inline" method="GET">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="filter" class="col-sm-2 col-form-label">Filtrēt pēc datuma</label>
                            <input type="date" class="form-control" id="filter" name="filter" placeholder="Product name..." value="{{$filter}}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 float">Filtrēt</button>
                    </form>

                    <form method="GET">
                        @csrf
                        <input class="form-control mb-3" name="filter" placeholder="Meklēt" value="{{$filter}}">
                        <button class="btn btn-primary" type="submit" >Meklēt</button>


                    </form>




                        <table class="table table table-hover" id="myTable">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="ps-5 text-secondary">@sortablelink('client.name', 'Vārds')</th>
                                <th scope="col" class="ps-5">@sortablelink('client.surname', 'Uzvārds')</th>
                                <th class="link-primary" onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(3)')"scope="col">Telefons</th>
                                <th class="link-primary" onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(4)')"scope="col">Sākuma laiks</th>
                                <th class="link-primary" onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(5)')"scope="col">Beigu laiks</th>
                                <th class="link-primary" onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(6)')"scope="col">Treneris</th>
                                <th class="link-primary" onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(7)')"scope="col">Telpa</th>
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

                                            @if(Auth::user()->role == "admin")
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Vai vēlaties dzēst ierakstu?')" >Izdzēst</button>
                                            <a href="{{ url('edit-visit/'.$visit->id) }}" class= "d-inline, btn btn-primary btn-sm">Rediģēt</a>
                                                @endif
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
