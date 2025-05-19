<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $fillable = [
        'questionaire',
        'question',
        'photo',
        'option1',
        'option2',
        'option3',
        'option4'
    ];
    public function Questionaires(){
        return $this->belongsTo(Questionaires::class,'questionaire');
    }
}
