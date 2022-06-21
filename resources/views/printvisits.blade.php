<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.printelement.min.js') }}"></script>
</head>
<body>

<div class="container">

    <div id="print">
        <h1 class="text-center">Rezervācija</h1>
        <table class="table table table-hover" id="myTable">
            <thead class="thead-dark">
            <tr>
                <th>Vārds</th>
                <th>Uzvārds</th>
                <th>Telefons</th>
                <th>Sākuma laiks</th>
                <th>Beigu laiks</th>
                <th>Treneris</th>
                <th>Telpa</th>
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
            </tr>
        @endforeach
            </tbody>
        </table>
                    <p class='text-right'><b>Kopējais rezervāciju skaits: {{$visits->count()}}</b></p>

    </div>
    <button class="btn btn-primary" onclick="printet()">Printēt</button>

</div>


</body>

<script>
    $(document).ready(function(){

        const printet = () => {

            $("#print").printElement();
        }

    });

    const printet = () => {

        $("#print").printElement();
    }

</script>


