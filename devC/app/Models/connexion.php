<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connexion extends Model
{
    /** @use HasFactory<\Database\Factories\ConnexionFactory> */
    use HasFactory;
    protected $fillable = ['sender_id, receiver_id, status'];

    // public function sender(){
    //     return $this->belongsTo(User::class, 'sender_connection');
    // }
    // public function receiver(){
    //     return $this->belongsTo(User::class, 'receiver_connection');
    // }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
