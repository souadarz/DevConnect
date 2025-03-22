<x-app-layout>
    <x-navBar />

    <div class="max-w-6xl w-full flex flex-col items-center mt-32 mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6">
        
        @foreach($connections->where('receiver_id', auth()->id())->where('status', 'pending') as $connection)
        <div class="max-w-5xl w-full flex flex-col md:flex-row items-center justify-between bg-white dark:bg-gray-800 rounded-xl shadow-xl border gap-6 p-6">
            <div class="flex flex-col items-center text-center">
                <img src="{{ Storage::url($connection->sender->picture) ?? 'https://avatar.iran.liara.run/public/boy' }}" alt="Profile Picture"
                    class="w-32 h-32 rounded-full object-cover border-2 border-gray-300 dark:border-gray-700">
                <h2 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">{{ $connection->sender->name }}</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ $connection->sender->email }}</p>
            </div>

            <div class="flex gap-4">
                <form action="/acceptConnection/{{$connection->id}}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-gradient-to-tr from-blue-800 to-purple-700 text-white text-lg rounded-full focus:outline-none hover:bg-blue-900">
                        Accept
                    </button>
                </form>

                <form action="/rejectConnection/{{$connection->id}}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-gray-300 text-gray-800 text-lg rounded-full focus:outline-none hover:bg-gray-400">
                        Reject
                    </button>
                </form>
            </div>
        </div>
        @endforeach

        <!--list des connections accepter -->
        <div class="max-w-5xl w-full bg-white dark:bg-gray-800 rounded-xl shadow-xl border mt-10 p-6">
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">accepted connexions</h3>
            <ul class="space-y-4">
                @foreach($connections->where('receiver_id', auth()->id())->where('status', 'accepted') as $connection)
                <li class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center gap-4">
                        <img src="{{ Storage::url($connection->sender->picture) ?? 'https://avatar.iran.liara.run/public/boy' }}" alt="Profile Picture"
                            class="w-12 h-12 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
                        <div>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $connection->sender->name }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $connection->sender->email }}</p>
                        </div>
                    </div>
                    <form action="{{ route('connection.delete',$connection->id ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette connection ?');">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="cursor-pointer text-red-500">
                    </form>
                    <span class="text-green-600 font-semibold">Connecté</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

</x-app-layout>