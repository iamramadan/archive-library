<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionaires;

class QuestionsController extends Controller
{
    public function CreateQuestions($id){
        $questionaire = Questionaires::find($id);
        if(!$questionaire){
            return redirect()->back()->with('error','Questionaire not found');
        }
        if($questionaire->questions()->exists()){
            $questions = $questionaire->questions()->get()->toArray();
            return view('create.questions',compact( ['id','questions','questionaire']));
        }
        return view('create.questions',compact( ['id','questionaire']));
    }
}
