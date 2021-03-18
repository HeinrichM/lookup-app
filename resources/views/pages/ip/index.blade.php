<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('IP Lookup') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <!-- Validation Errors -->
        <div class="flex justify-center">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
        <form action="{{route('ip.store')}}" method="POST">
            @csrf
            <div class="flex justify-center">
                <input type="text" name="ip" class="rounded-lg border-gray-300" placeholder="Search IP address" required>
                <button class="p-2 bg-blue-400 rounded-lg mx-4"><i class="fas fa-search px-2"></i>Search</button>
            </div>
        </form>

        @if(session('error'))
            {{ session('error') }}
        @endif
        <div>
            <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-300 text-gray-800">
                <thead>
                    <tr class="text-left border-b-2 border-gray-500">
                        <td class="px-4 py-3">IP</td>
                        <td class="px-4 py-3">Continent</td>
                        <td class="px-4 py-3">Country</td>
                        <td class="px-4 py-3">Region</td>
                        <td class="px-4 py-3">City</td>
                        <td class="px-4 py-3">Organisation</td>
                        <td class="px-4 py-3">First Lookup</td>
                        <td class="px-4 py-3">Latest Lookup</td>
                        <td class="px-4 py-3">Status</td>
                    </tr>
                </thead>
                <tbody>
            @if($ipAddress)
                <tr class="bg-blue-200 border-b border-gray-200">
                    <td class="px-4 py-3">{{$ipAddress->ip}}</td>
                    <td class="px-4 py-3">{{$ipAddress->continent_code}}</td>
                    <td class="px-4 py-3">{{$ipAddress->country_name}}</td>
                    <td class="px-4 py-3">{{$ipAddress->region}}</td>
                    <td class="px-4 py-3">{{$ipAddress->city}}</td>
                    <td class="px-4 py-3">{{$ipAddress->org}}</td>
                    <td class="px-4 py-3">{{$ipAddress->created_at->diffForHumans()}}</td>
                    <td class="px-4 py-3">{{$ipAddress->updated_at->diffForHumans()}}</td>
                    <td class="px-4 py-3">
                        <span id="statusText">{{$ipAddress->status}}</span>
                        <i onclick="toggleIP(this,'{{$ipAddress->id}}');" class="cursor-pointer fas {{$ipAddress->status == 'Allowed' ? 'fa-check-circle' : 'fa-times-circle'}}"></i>
                    </td>
                </tr>
            @endif
            @forelse($lookupHistory as $historyIp)
                @php if($historyIp->ip == ($ipAddress ?  $ipAddress->ip : null) && $loop->first){continue;} @endphp
                <tr class="even:bg-gray-100 odd:bg-gray-200 border-b border-gray-200">
                    <td class="px-4 py-3">{{$historyIp->ip}}</td>
                    <td class="px-4 py-3">{{$historyIp->continent_code}}</td>
                    <td class="px-4 py-3">{{$historyIp->country_name}}</td>
                    <td class="px-4 py-3">{{$historyIp->region}}</td>
                    <td class="px-4 py-3">{{$historyIp->city}}</td>
                    <td class="px-4 py-3">{{$historyIp->org}}</td>
                    <td class="px-4 py-3">{{$historyIp->created_at->diffForHumans()}}</td>
                    <td class="px-4 py-3">{{$historyIp->updated_at->diffForHumans()}}</td>
                    <td class="px-4 py-3">
                        <span id="statusText">{{$historyIp->status}}</span>
                        <i onclick="toggleIP(this,'{{$historyIp->id}}');" class="cursor-pointer fas {{$historyIp->status == 'Allowed' ? 'fa-check-circle' : 'fa-times-circle'}}"></i>
                    </td>
                </tr>
            @empty

            @endforelse
                </tbody>
            </table>
            {{$lookupHistory->links()}}
        </div>
    </div>

    <script>
        function toggleIP(element,ipAddress){
            $.ajax({
                url: "/ip/"+ipAddress+"/toggle",
                success: function(result){
                    if(result.status == 'Allowed'){
                        $(element).removeClass('fa-times-circle');
                        $(element).addClass('fa-check-circle');
                        $(element).siblings('#statusText').html('Allowed');
                    } else {
                        $(element).removeClass('fa-check-circle');
                        $(element).addClass('fa-times-circle');
                        $(element).siblings('#statusText').html('Blocked');
                    }
                }
            });
        }
    </script>

</x-app-layout>
