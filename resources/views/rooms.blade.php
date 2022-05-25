<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Telpas') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{route("addroom")}}" class="btn btn-primary">Pievienot telpu</a>
                    @foreach($rooms as $room)

                    @endforeach

                    <table class="table" id="myTable">
                        <thead class="thead-dark">
                        <tr>
                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(1)')" scope="col">Telpa</th>
                            <th onclick="w3.sortHTML('#myTable','.item', 'td:nth-child(2)')" scope="col">Aprasts</th>
                            <th style="width: 150px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rooms as $room)

                            <tr class="item">
                                <td >{{$room->name}}</td>
                                <td>{{$room->description}}</td>
                                <td><form action="{{route("rooms.delete", $room)}}"method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" >Izdzēst</button>
                                        <a href="{{ url('edit-room/'.$room->id) }}" class= "d-inline, btn btn-primary btn-sm">Rediģēt</a>
                                    </form></td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
