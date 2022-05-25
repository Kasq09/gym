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



                    <form method="post" action="{{url("update-room/".$room->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <label for="name" class="form-label">Telpa</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$room->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">Apraksts</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{$room->description}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
