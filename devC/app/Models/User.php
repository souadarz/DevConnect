<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'picture',
        'bio'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    // public function connexions(){
    //     return $this->hasMany(Connexion::class );
    // }

    public function sentConnections()
    {
        return $this->hasMany(Connexion::class, 'sender_id');
    }

    // Connexions reçues (l'utilisateur est le receiver)
    public function receivedConnections()
    {
        return $this->hasMany(Connexion::class, 'receiver_id');
    }

    // Obtenir les utilisateurs connectés (connexions acceptées)
    public function connections()
    {
        return $this->belongsToMany(User::class, 'connexions', 'sender_id', 'receiver_id');
    }

    public function Comments(){
        return $this->hasMany(Comment::class);
    }

    public function skills(){
        return $this->belongsToMany(Skills::class,'user_skills');
    }

    public function likes(){
        return $this->belongsToMany(Post::class,'likes');
    }
}
