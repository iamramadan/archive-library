<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable=[
      'token',
      'type',
      'system',
      'max_usage',
      'expires_at'  
    ];
    public function System(){
        return $this->belongsTo(System::class,'system');
    }
    public function Users(){
        return $this->belongsToMany(User::class, 'ticket','user' );
    }
}
