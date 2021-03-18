<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cell Number Lookup') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <!-- Validation Errors -->
        <div class="flex justify-center">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
        <form action="{{route('cellnumber.store')}}" method="POST">
            @csrf
            <div class="flex justify-center">
                <input type="text" name="number" class="rounded-lg border-gray-300" placeholder="Search cell number" required>
                <button class="p-2 bg-blue-400 rounded-lg mx-4"><i class="fas fa-search px-2"></i>Search</button>
            </div>
        </form>

        @if(session('error'))
            {{ session('error') }}
        @endif
        <div>
            @if($cellNumber)
                <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-200 text-gray-800">
                    <thead>
                    <tr class="text-left border-b-2 border-gray-300">
                        <td class="px-4 py-3">Cell Number</td>
                        <td class="px-4 py-3">Original Network</td>
                        <td class="px-4 py-3">Current Network</td>
                    </tr>
                    </thead>
                    <tbody>

                        <tr class="bg-blue-200 border-b border-gray-200">
                            <td class="px-4 py-3">{{$cellNumber->cell_number}}</td>
                            <td class="px-4 py-3">{{$cellNumber->original_network}}</td>
                            <td class="px-4 py-3">{{$cellNumber->current_network}}</td>
                        </tr>

                    </tbody>
                </table>
            @endif
        </div>
    </div>

</x-app-layout>
