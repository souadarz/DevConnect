import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    const notificationCount = document.getElementById("count_notif");

    if (!notificationCount) return;

    // Fonction pour mettre à jour le compteur des notifications
    function updateNotificationCount() {
        fetch("/notifications/count")
            .then(response => response.json())
            .then(data => {
                console.log("Nombre de notifications :", data.count);
                
                if (Number.isInteger(data.count) && data.count > 0) {
                    notificationCount.textContent = data.count;
                    notificationCount.style.display = "flex";
                    
                    // Stocker le nombre de notifications dans le localStorage
                    localStorage.setItem('notificationCount', data.count);
                } else {
                    notificationCount.style.display = "none";
                    localStorage.removeItem('notificationCount');
                }
            })
            .catch(error => {
                console.error("Erreur lors de la récupération des notifications :", error);
                
                // En cas d'erreur, essayer de récupérer le nombre de notifications du localStorage
                const storedCount = localStorage.getItem('notificationCount');
                if (storedCount) {
                    notificationCount.textContent = storedCount;
                    notificationCount.style.display = "flex";
                }
            });
    }

    // Charger les notifications au chargement de la page
    updateNotificationCount();

    // Vérifier si l'utilisateur est connecté avant d'écouter Pusher
    const userIdMeta = document.querySelector('meta[name="user-id"]');
    if (userIdMeta) {
        const userId = userIdMeta.content;

        // Mettre à jour en temps réel avec Pusher (Echo)
        Echo.private(`notifications.${userId}`)
            .listen('NewNotification', (event) => {
                updateNotificationCount();
            });
    }

    // Mise à jour périodique (ex: toutes les 30 secondes) au cas où une notification ne serait pas reçue en temps réel
    setInterval(updateNotificationCount, 30000);

    // Gérer le clic sur les notifications pour les marquer comme lues
    const notificationBell = document.getElementById('notification-bell'); // Ajoutez un ID à votre élément de cloche de notification
    if (notificationBell) {
        notificationBell.addEventListener('click', function() {
            // Marquer toutes les notifications comme lues
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                notificationCount.style.display = "none";
                localStorage.removeItem('notificationCount');
            })
            .catch(error => console.error('Erreur :', error));
        });
    }
});