<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'result',
        'user',
        'score',
        'questionaires'
    ];
    public function User() :belongsTo
    {
        return $this->belongsTo(User::class,'user');
    }
    public function Questionaires(){
        return $this->belongsTo(Questionaires::class,'questionaires');
    }
}
