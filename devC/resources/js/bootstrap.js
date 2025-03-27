// import axios from 'axios';
// window.axios = axios;

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

// import './echo';

// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

// window.Pusher = Pusher;
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

// window.Echo.private(`App.Models.User.${userId}`)
//     .notification((notification) => {
//         alert(`New notification: ${notification.message}`);
//     });


import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

// Récupérer l'ID utilisateur de manière sécurisée
const userIdMeta = document.querySelector('meta[name="user-id"]');
const userId = userIdMeta ? userIdMeta.content : null;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

if (userId) {
    window.Echo.private(`App.Models.User.${userId}`)
        .notification((notification) => {
            // Mettre à jour le compteur de notifications
            updateNotificationCounter();
        });
}

function updateNotificationCounter() {
    const notificationCount = document.getElementById('count_notif');
    if (!notificationCount) return;

    fetch('/notifications/count')
        .then(response => response.json())
        .then(data => {
            console.log('Notification count:', data.count);
            notificationCount.textContent = data.count;
            notificationCount.style.display = data.count > 0 ? 'block' : 'none';
        })
        .catch(error => console.error('Error fetching notification count:', error));
}

// Charger le compteur initial
document.addEventListener('DOMContentLoaded', () => {
    updateNotificationCounter();
});

