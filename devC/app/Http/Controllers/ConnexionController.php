<?php

namespace App\Http\Controllers;

use App\Events\TestNotification;
use App\Models\Connexion;
use App\Http\Requests\StoreconnexionRequest;
use App\Http\Requests\UpdateconnexionRequest;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\ConnexionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = User::where('id',$user_id)->first();
        $connections = Connexion::all();
        return view('/connections', compact('connections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function sendConnection(Request $request, $receiver_id)
    {
        $sender_id = Auth::id();

        // Vérifier si la connexion existe déjà
        $existingConnection = Connexion::where(function ($query) use ($sender_id, $receiver_id) {
            $query->where('sender_id', $sender_id)
                ->where('receiver_id', $receiver_id);
        })->exists();
        if ($existingConnection) {
            return redirect()->back()->with('error', 'You already have a existing connection with this user.');
        }

        $connection = new Connexion();
        $connection->sender_id = Auth::id();
        $connection->receiver_id = $receiver_id;
        $connection->status = 'pending';
        $connection->save();

        $user_name = Auth::user()->name;
        // $user = User::find(Auth::id());
        // $user->notify(new ConnexionNotification($user_name, $receiver_id));

        $receiver = User::find($receiver_id);

        if ($receiver) {
            $receiver->notify(new ConnexionNotification($user_name, $receiver_id));

            $notifCount = $receiver->unreadNotifications()->count();

            // $notifCount = Notification::count();
            event(new TestNotification([
                'receiver_id' => $receiver_id,
                'user_name' => $user_name,
                'message' => 'You Have An Invitation From',
                'count_notifications' => $notifCount
            ]));
            // dd($test);

            return redirect()->back()->with('success', 'connection created successfully!');
        }
        return redirect()->back()->with('error', 'User not found.');
    }

    public function acceptConnection($connexion_id)
    {

        $connection = Connexion::where('receiver_id', Auth::id())->where('id', $connexion_id)->first();
        // dd($connection);
        // $connection->update(['status' => 'accepted']);
        $connection->status = 'accepted';
        $connection->save();

        return redirect()->back();
    }

    public function rejectConnection($connexion_id)
    {

        $connection = Connexion::where('receiver_id', Auth::id())->where('id', $connexion_id)->first();
        $connection->delete();
        return redirect()->back()->with('message', 'Connection request rejected');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreconnexionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(connexion $connexion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(connexion $connexion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateconnexionRequest $request, connexion $connexion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(connexion $connexion)
    {
        $connexion->delete();
        return redirect()->back();
    }
}
