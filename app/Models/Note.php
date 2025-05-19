<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;
    protected $fillable =[
        'author',
        'system',
        'title',
        'body'
    ];
    public function User(){
        return $this->belongsTo(Note::class,'author');
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
