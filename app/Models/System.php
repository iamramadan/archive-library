<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Scopes\ContributableSystems;

class System extends Model
{
    use HasFactory;
    protected $fillable = [
        'creator',
        'name',
        'logo',
        'about'
    ];
    public function Users(){
        return $this->belongsTo(User::class,'creator');
    }
    public function Note(){
        return $this->hasMany(Note::class,'system');
    }
    public function Questionaires(){
        return $this->hasMany(Questionaires::class,'system');
    }
    public function Resources(){
        return $this->hasMany(Resources::class,'system');
    }
    public static function booted(){
        static::addGlobalScope(new ContributableSystems());
    }
}
