<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications;
        // dd($notifications[0]->data['message']);
        return view('/notifications', compact('notifications'));
    }

    public function markAsRead($id) {
        $notification = auth()->user()->notifications()->find($id);
    
        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notification introuvable'], 404);
        }
    
        $notification->markAsRead();
    
        return response()->json([
            'success' => true,
            'count' => auth()->user()->unreadNotifications()->count()
        ]);
    }
    
    public function getUnreadNotificationsCount()
    {
        if (!auth()->check()) {
            return response()->json(['count' => 0]);
        }
        $count = Auth::user()->unreadNotifications->count();
        return response()->json([
            'count' => $count
        ]);
    }

    public function markAllAsRead()
    {
        if (!auth()->check()) {
            return response()->json(['success' => false]);
        }

        Auth::user()->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }
}
