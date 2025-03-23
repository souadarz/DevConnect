<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications;
        // dd($notifications);
        return view('/notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification =Auth::user()->notifications->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return back();
    }

    public function getUnreadNotificationsCount()
    {
        return response()->json([
            'count' => Auth::user()->unreadNotifications->count()
        ]);
    }
}
