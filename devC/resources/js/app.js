import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// document.addEventListener("DOMContentLoaded", function () {
//     const notificationCount = document.getElementById("count_notif");

//     // Fonction pour mettre à jour le compteur
//     function updateNotificationCount() {
//         fetch("/notifications/count")
//             .then(response => response.json())
//             .then(data => {
//                 if (data.count > 0) {
//                     notificationCount.textContent = data.count;
//                     notificationCount.style.display = "flex"; // Affiche si > 0
//                 } else {
//                     notificationCount.style.display = "none"; // Cache si 0
//                 }
//             })
//             .catch(error => console.error("Erreur:", error));
//     }

//     // Charger les notifications au chargement de la page
//     updateNotificationCount();

//     // Mettre à jour en temps réel avec Pusher
//     Echo.private(`notifications.${document.querySelector('meta[name="user-id"]').content}`)
//         .listen('NewNotification', (e) => {
//             updateNotificationCount();
//         });
// });


document.addEventListener("DOMContentLoaded", function () {
    const notificationCount = document.getElementById("count_notif");

    if (!notificationCount) return; // Éviter les erreurs si l'élément n'existe pas

    // Fonction pour mettre à jour le compteur des notifications
    function updateNotificationCount() {
        fetch("/notifications/count")
            .then(response => response.json())
            .then(data => {
                if (data.count && data.count > 0) {
                    notificationCount.textContent = data.count;
                    notificationCount.style.display = "flex"; // Afficher si > 0
                } else {
                    notificationCount.style.display = "none"; // Cacher si 0
                }
            })
            .catch(error => console.error("Erreur lors de la récupération des notifications :", error));
    }

    // Charger les notifications au chargement de la page
    // updateNotificationCount();

    // Vérifier si l'utilisateur est connecté avant d'écouter Pusher
    const userIdMeta = document.querySelector('meta[name="user-id"]');
    if (userIdMeta) {
        const userId = userIdMeta.content;

        // Mettre à jour en temps réel avec Pusher (Echo)
        Echo.private(`notifications.${userId}`)
            .listen('NewNotification', () => {
                updateNotificationCount();
            });
    }

    // Mise à jour périodique (ex: toutes les 30 secondes) au cas où une notification ne serait pas reçue en temps réel
    setInterval(updateNotificationCount, 30000);
});
