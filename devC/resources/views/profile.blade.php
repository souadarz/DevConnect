<x-app-layout>
    <x-navBar />
<div class="max-w-5xl w-full flex justify-center mx-auto mt-32  bg-white dark:bg-gray-800 rounded-xl shadow-xl">
    <!-- Profile Section -->
    
    <div class="w-full md:w-1/3 items-center text-center flex flex-col p-4 rounded-lg">
            <img src="{{Storage::url($user->picture)}}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover border-2 border-gray-300 dark:border-gray-700">
            <h2 class="mt-4 text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
            <p class="text-gray-600 ">{{ $user->email }}</p>
            @if($user->Bio)
            <p class="mt-2 text-sm text-gray-700">Bio : {{ $user->Bio }}</p>
            @endif
            @if($user->skills)
            <div class="mt-4 flex flex-wrap gap-2">
                <span  class="text-gray-600" >Skills :</span>
                @foreach($user->skills as $skill)
                <span class="px-2 py-1 bg-purple-100 text-purple-900 rounded-full text-xs">{{ $skill->name }}</span>
                @endforeach
            </div>
            @endif

        </div>

    <!-- Send Connection Button -->
    <div class="w-full md:w-1/3 flex justify-center items-center mt-10 md:mt-0">
        <form action="{{route('connection.send', $user->id) }}" method="POST">
            @csrf
            <button type="submit" class="px-6 py-3 bg-blue-500 text-white text-lg rounded-full hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300 ease-in-out">
                Send Connection
            </button>
            @if (session('error'))
            <div class="alert text-red-500">
                {{ session('error') }}
            </div>
            @endif
        </form>
    </div>
</div>
<x-pusher1></x-pusher1>
</x-app-layout>