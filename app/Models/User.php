<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function Note(){
        return $this->hasMany(Note::class,'author');
    }
    public function Questionaires(){
        return $this->hasMany(Questionaires::class,'author');
    }
    public function Resources(){
        return $this->hasMany(Resources::class,'author');
    }
    public function System(){
        return $this->hasMany(System::class,'creator');
    }
    public function Ticket(){
        return $this->belongsToMany(Ticket::class,'users_tickets', 'user_id', 'ticket_id');
    }
}
