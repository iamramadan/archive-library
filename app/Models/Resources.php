<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resources extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'author',
        'system',
        'filename',
        'details'
    ];
    public function Users(){
        return $this->belongsTo(User::class,'author');
    }
    public function System(){
        return $this->belongsTo(System::class,'system');
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
