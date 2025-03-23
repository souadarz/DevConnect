<x-app-layout>
    <x-navBar />
    <div class="w-3/4 container mx-auto mt-32">
        <h2 class="text-2xl font-semibold mb-4">Notifications</h2>
        <ul class="bg-white p-4 rounded-lg shadow space-y-2">
            @forelse($notifications as $notification)
            <li class="flex items-center justify-between border-b py-2 {{ $notification->read_at ? 'bg-gray-100' : 'bg-blue-50' }} rounded-lg">
                <div class="flex items-center space-x-3">
                    <span class="text-lg font-medium text-gray-900 ml-3">{{ $notification->data['message'] }}</span>
                    <span class="text-gray-500 text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                </div>
                
                <!-- Bouton pour marquer comme lu -->
                @if (!$notification->read_at)
                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-s text-purple-500 hover:text-purple-700 focus:outline-none mr-2">Mark As Read</button>
                    </form>
                @endif
            </li>
            @empty
            <li class="text-gray-500">Aucune notification</li>
            @endforelse
        </ul>
    </div>
    <x-pusher1 />
</x-app-layout>
