<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionaires;

class QuestionsController extends Controller
{
    public function CreateQuestions($id){
        $questionaire = Questionaires::find($id);
        return view('create.questions',compact( ['id','questionaire']));
    }
}
