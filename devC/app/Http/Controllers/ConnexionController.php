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
        return view('/connections',);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function sendConnection(Request $request,$receiver_id)
    {
        $connection = new Connexion();
        $connection->sender_id = Auth::id();
        $connection->receiver_id = $receiver_id;
        $connection->status = 'pending';
        $connection->save();
        $user_name = Auth::user()->name;
        
        // if (Auth::id() === $connection->sender_id) {
            // $user = $connection->sender_id;
            $user = User::find(Auth::id());
            $user->notify(new ConnexionNotification($user_name,$receiver_id));
            
            $notifCount = Notification::count();
            event(new TestNotification([
                'receiver_id' => $receiver_id,
                'user_name' => $user_name,
                'message' => 'You Have An Invitation From',
                'count_notifications' => $notifCount
            ]));
        // dd($test);
    
        return redirect()->back()->with('success', 'connection created successfully!');
        
    }

    public function acceptConnection($connexion_id) {
        $connection = Connexion::where('receiver_id', Auth::id())->findOrFail($connexion_id);
        $connection->update(['status' => 'accepted']);
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
        //
    }
}
