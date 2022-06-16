<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rediģēt klientu') }}
        </h2>
    </x-slot>
    @if(Auth::user()->role == "admin")
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">



                    <form method="post" action="{{url("update-client/".$client->id)}}" class="pb-4">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <label for="name" class="form-label">Vārds</label>
                            <input type="text" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" class="form-control" id="name" name="name" value="{{$client->name}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">Uzvārds</label>
                            <input type="text" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" class="form-control" id="surname" name="surname" value="{{$client->surname}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefons</label>
                            <input type="text" pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" class="form-control" id="phone" name="phone" value="{{$client->phone}}" required>
                        </div>
                        <button type="submit" class="btn btn-primary float-end mb-3">Apstiprināt</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
        <h1 class="text-center" >Jums nav piekļuves šai lapai</h1>
    @endif
</x-app-layout>
