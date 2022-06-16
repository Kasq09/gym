<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sākums') }}
        </h2>
    </x-slot>
    @if(Auth::user()->role == "admin")
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">



                    <form method="post" action="{{url("update-visit/".$visit->id)}}">
                        @csrf
                        @method("PUT")
                        <select class="form-select mb-4" aria-label="Default select example"  name="client_id">

                        @foreach($clients as $client)
                            @if($client->id==$visit->client_id)
                                    <option selected="selected" name="client_id" value="{{$client->id}}">{{$client->name}} {{$client->surname}} </option>
                                @else
                                    <option name="client_id" value="{{$client->id}}">{{$client->name}} {{$client->surname}} </option>
                                @endif

                            @endforeach
                        </select>

                            <select class="form-select mb-4" aria-label="Default select example" name="room_id">

                            @foreach($rooms as $room)
                                <option value="{{$room->id}}">{{$room->name}}  </option>
                                @endforeach
                            </select>

                        <select class="form-select mb-4" aria-label="Default select example"  name="user_id">


                            @foreach($coaches as $coach)
                                <option value="{{$coach->id}}">{{$coach->name}} {{$coach->surname}} </option>
                            @endforeach
                        </select>
                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Sākuma laiks</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{str_replace(" ", "T", $visit->start_time)}}">
                                </div>
                                <div class="mb-3">
                                    <label for="end_time" class="form-label">Beigu laiks</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{str_replace(" ", "T", $visit->end_time)}}">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
        <h1 class="text-center" >Jums nav piekļuves šai lapai</h1>
    @endif
</x-app-layout>
