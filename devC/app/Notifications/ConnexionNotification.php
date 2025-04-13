<?php

namespace App\Notifications;

use App\Models\Connexion;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Support\Facades\Auth;

class ConnexionNotification extends Notification
{
    use Queueable;

    public $user_name;
    public $receiver_id;

    public function __construct($user_name, $receiver_id)
    {
        $this->user_name = $user_name;
        $this->receiver_id = $receiver_id;
    }

    // Store the notification in the database
    public function toDatabase($notifiable)
    {
        // $user_name = Auth::user()->name;
        return [
            'receiver_id' => $this->receiver_id,
            'user_name' => $this->user_name,
            'message' => 'You Have An Invitation From' . $this->user_name,
        ];
    }

    // Broadcast the notification using Pusher
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'receiver_id' => $this->receiver_id,
            'user_name' => $this->user_name,
            'message' => 'You Have An Invitation From' . $this->user_name,
        ]);
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // Save to database and broadcast in real-time
    }

    public function toArray($notifiable)
    {
        return [
            'receiver_id' => $this->receiver_id,
            'user_name' => $this->user_name,
            'message' => 'You Have An Invitation From ' . $this->user_name,
        ];
    }
}
