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
        'body',
        'image'
    ];
    public function User(){
        return $this->belongsTo(Note::class,'author');
    }
    public function System(){
        return $this->belongsTo(System::class,'system');
    }
    public static function createIfContributor(array $data, $system, User $user)
{
    $hasAccess = System::where('id', $system)->where('creator', $user->id)->exists() ||
                 $user->Ticket()->where('type', 'contributor')->where('system', $system)->exists();

    return $hasAccess ? Note::create($data) : false;
}
}
