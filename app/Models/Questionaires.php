<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Questionaires extends Model
{
    use HasFactory;
    protected $fillable = [
        'author',
        'name',
        'goal',
        'system'
    ];
    public function Users(){
        return $this->belongsTo(User::class,'author');
    }
    public function System(){
        return $this->belongsTo(System::class,'system');
    }
    public function Questions(){
        return $this->hasMany(Questions::class,'questionaire');
    }
    public static function createIfContributor(array $data, $system, User $user)
{
    $isContributor = $user->tickets()
        ->where('type', 'contributor')
        ->where('system', $system)
        ->exists();

    return $isContributor
        ? Note::create($data)
        : null;
}
}
