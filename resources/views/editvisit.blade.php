<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rediģēt rezervāciju') }}
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

                        <option name='coach_id'></option>

                            @foreach($coaches as $coach)
                            @if($coach->id == $visit->coach_id)
                                <option selected name='coach_id' value="{{$coach->id}}">{{$coach->name}} {{$coach->surname}} </option>
                            @else
                                <option name='coach_id' value="{{$coach->id}}">{{$coach->name}} {{$coach->surname}} </option>
                            @endif
                            @endforeach
                        </select>
                                <div class="mb-3">
                                    <label  for="start_time" class="form-label">Sākuma laiks</label>
                                    <input id='time1' type="datetime-local" class="form-control" name="start_time" value="{{str_replace(" ", "T", $visit->start_time)}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="end_time" class="form-label">Beigu laiks</label>
                                    <input id='time2' type="datetime-local" class="form-control" name="end_time" value="{{str_replace(" ", "T", $visit->end_time)}}" required>
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
<script>
$(document).ready(function(){

let date = new Date($('#time1').val())
$('#time2').attr('min', $('#time1').val())
$('#time2').attr('max', new Date(date.setHours(23)).toISOString().substring(0,16))


    $('#time1').change(function(){
        if(new Date($('#time1').val()).getHours() < 14 || new Date($('#time1').val()).getHours() > 20) {
            alert('Darba laiks ir no 14.00 līdz 20.00')
            $('#time1').val('')
        } else {
            let date = new Date($('#time1').val())
            $('#time2').attr('min', $('#time1').val())
            $('#time2').attr('max', new Date(date.setHours(23)).toISOString().substring(0,16))
            $('#time2').val('')
        }
    })

    $('#time2').change(function(){
        if(new Date($('#time2').val()).getHours() < 14 || new Date($('#time2').val()).getHours() > 20) {
            alert('Darba laiks ir no 14.00 līdz 20.00')
            $('#time2').val('')
        } else if($('#time2').val() < $('#time1').val()) {
            alert('Nevar izvēlēties beigu laiku, kas ir pirms sākuma laika')
            $('#time2').val('')
        }
    })
});
</script>