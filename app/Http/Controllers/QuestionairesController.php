<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;
use App\Models\Questionaires;
use App\Models\Result;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class QuestionairesController extends Controller
{

    public function CreateQuestionaires(){
        $systems = System::all();
        return view('create.questionaire',compact(['systems']));
    }
    public function store(Request $request ){
        $data = $request->validate([
            'name'=>'min:8|max:200|required',
            'goal'=>'max:500|required',
            'author'=>'required',
            'system'=>'required'
        ]);
       $questionaire =  Questionaires::createIfContributor($data,$request->system,Auth::user());
        if($questionaire){
            return redirect()->route('create.questions',['id'=>$questionaire->id]);
        }
    return back()->with('error','could not create questionaire');
    }
    public function submit(Request $request){
        $request->validate([
            'answers' => 'array|required',
            'questionaireId' => 'required|interger|exists:questionaires,id'
        ]);
        $questions = Questionaires::with('questions')->find($request->questionaireId);
        $i = 0;
        $mark = 0;
        foreach ($questionaire->questions as $question) {
            if ($question->correct_option == $request->answers[$i]) {
                $mark ++
            }
            $i++
        }
        $score = $mark/count($request->answers);
        Result::UpdateorCreate(
            [
                'user'=>Auth::user()->id,
                'questionaire'=>$questionaire->id
        ],
        [
            'result'=>$mark,
            'score'=>$score * 100,
            'user'=> Auth::user()->id,
            'questionaires'=>$questionaire->id,
            'your_options'=>$request->answers
        ]);
        return redirect()->route('pages.questionaire.result',['id'=>$questionaire->id]);
    }
}
