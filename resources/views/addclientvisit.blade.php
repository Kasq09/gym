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

                            <h3>Pievienot rezervāciju priekš
                                @foreach($clients as $client)
                                    {{ $client->name }} {{ $client->surname }}
                                    <input hidden name="client_id" value="{{$client->id}}">
                                @endforeach
                            </h3>

                            @csrf
                            <select class="form-select mb-4" aria-label="Default select example" name="room_id" required>


                                <option value="" disabled selected required>Izvēlēties telpu</option>
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
                                <input id='time1' type="datetime-local" class="form-control" id="start_time" name="start_time" required
                                min='{{ \Carbon\Carbon::now()->format('Y-m-d')}}T{{ \Carbon\Carbon::now()->format('h:m') }}'
                                >
                            </div>
                            <div class="mb-3">
                                <label for="end_time" class="form-label">Beigu laiks</label>
                                <input id='time2' type="datetime-local" class="form-control" id="end_time" name="end_time" required>
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
<script>
function addHoursToDate(date, hours) {
  return new Date(new Date(date).setHours(date.getHours() + hours));
}
$(document).ready(function(){



    $('#time1').change(function(){
        if(new Date($('#time1').val()).getHours() < 14 || new Date($('#time1').val()).getHours() > 20) {
            alert('Darba laiks ir no 14.00 līdz 20.00')
            $('#time1').val('')
        } else {
            let date = new Date($('#time1').val())
            alert(new Date(date.setHours(23)).toISOString().substring(0,16))
            $('#time2').attr('min', $('#time1').val())
            $('#time2').attr('max', new Date(date.setHours(23)).toISOString().substring(0,16))
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