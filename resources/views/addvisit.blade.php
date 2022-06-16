<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pievienot rezervāciju') }}
        </h2>
    </x-slot>
    @if(Auth::user()->role == "admin")
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{route("addvisit")}}">



                        @csrf
                        <select class="form-select mb-4" aria-label="Default select example"  name="client_id" required>


                           <option value="" disabled selected>Izvēties klientu</option>
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->surname}} {{$client->name}} </option>
                            @endforeach
                        </select>

                        <select class="form-select mb-4" aria-label="Default select example" name="room_id" required>


                            <option value="" disabled selected>Izvēlēties telpu</option>
                            @foreach($rooms as $room)
                                <option value="{{$room->id}}">{{$room->name}} </option>
                            @endforeach
                        </select>

                        <select class="form-select mb-4" aria-label="Default select example"  name="user_id">


                            <option value="" disabled selected>Izvēties treneri</option>
                            @foreach($coaches as $coach)
                                <option value="{{$coach->id}}">{{$coach->name}} {{$coach->surname}} </option>
                            @endforeach
                        </select>

                        <div class="mb-3">
                            <label for="start_time" class="form-label">Sākuma laiks </label>
                            <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_time" class="form-label">Beigu laiks</label>
                            <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Pievienot</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @else
        <h1 class="text-center" >Jums nav piekļuves šai lapai</h1>
    @endif
</x-app-layout>
