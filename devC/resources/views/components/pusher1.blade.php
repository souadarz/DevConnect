<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusher Test with Icons</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> -->
<style>
    .toast-info .toast-message {
        display: flex;
        align-items: center;
    }

    .toast-info .toast-message i {
        margin-right: 10px;
    }

    .toast-info .toast-message .notification-content {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
</style>
<script>
        @php
        $userId = auth() -> check()? auth() -> user() -> id : 0;
        @endphp
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
        });

        var channel = pusher.subscribe('notification');
        channel.bind('test.notification', function(data) {
            if (parseInt(data.receiver_id) == parseInt({{ $userId }}) ){
                if (data.user_name) {
                    count_notif.textContent = data.count_notifications;
                    toastr.info(
                        `<div class="notification-content">
                            <span>${data.user_name}</span>
                        </div>`,
                        {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 0,
                            extendedTimeOut: 0,
                            positionClass: 'toast-top-right',
                            enableHtml: true
                        }
                    );
                } else {
                    console.error('Invalid data received:', data);
                }
            }
        });

        pusher.connection.bind('connected', function() {
            console.log('Pusher connected');
        });
    </script>
<!-- </head>
<body>
    <p>Try publishing a new post to see the notification in action.</p>
</body>
</html> -->
<!-- <h1>Pusher Test with Icons</h1> -->