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

                @if (!$notification->read_at)
                <button
                    type="button"
                    data-notification-id="{{ $notification->id }}"
                    onclick="markNotificationAsRead('{{ $notification->id }}')"
                    class="text-s text-purple-500 hover:text-purple-700 focus:outline-none mr-2">
                    Mark As Read
                </button>
                @endif
            </li>
            @empty
            <li class="text-gray-500">Aucune notification</li>
            @endforelse
        </ul>
    </div>

    @push('scripts')
    <script>
        function markNotificationAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/read`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Vérifier si la requête a réussi
                    if (data.success) {
                        document.querySelector(`[data-notification-id="${notificationId}"]`).remove();

                        // Mettre à jour le compteur de notifications
                        const notificationCount = document.getElementById('count_notif');
                        if (notificationCount) {
                            notificationCount.textContent = data.count;
                            notificationCount.style.display = data.count > 0 ? 'block' : 'none';
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
    @endpush
</x-app-layout>