<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\System;
use Illuminate\Http\Request;
use App\Models\Questionaires;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuestionairesController extends Controller
{

    public function CreateQuestionaires(){
        $systems = System::all();
        return view('create.questionaire',compact(['systems']));
    }
    
public function show(Request $request) {
    $authorId = Auth::id();
    $currentSystem = $request->query('system');

    $base = Questionaires::where('author', $authorId);
    $system = System::where('name',$currentSystem)->value('id');
    $questionaires = $currentSystem
        ? (clone $base)->where('system', $system)->get()
        : (clone $base)->get();

    $systems = System::all();
    $all = (clone $base)->count();
    $systemCounts = Questionaires::select('system', DB::raw('COUNT(*) as total'))
        ->where('author', $authorId)
        ->groupBy('system')
        ->pluck('total', 'system');

    $all = (clone $base)->count();

    return view('pages.manage.questionaire', compact('all','questionaires','systems','all','systemCounts','currentSystem'));
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
            'questionaireId' => 'required|integer|exists:questionaires,id'
        ]);
        $questionaire = Questionaires::with('questions')->find($request->questionaireId);
        $i = 1;
        $mark = 0;
        $toAlpha = ['1'=>'a',
        '2'=>'b',
        '3'=>'c',
        '4'=>'d'
    ];
        foreach ($questionaire->questions as $question) {
            if ($toAlpha[$question->correct_option] == $request->answers[$i]) {
                $mark ++;
            }
            $i++;
        }
        // dd($mark);
        $score = $mark/count($request->answers);
        Result::UpdateorCreate(
            [
                'user'=>Auth::user()->id,
                'questionaires'=>$questionaire->id
        ],
        [
            'result'=>$mark,
            'score'=>$score * 100,
            'user'=> Auth::user()->id,
            'questionaires'=>$questionaire->id,
            'your_answers'=>$request->answers
        ]);
        return redirect()->route('pages.questionaire.result',['id'=>$questionaire->id]);
    }
    public function delete(Request $request){
       return  Questionaires::where('id',$request->id)->delete() 
       ? redirect()->route('pages.manage.questionaires')->with('success','Successfully Deleted Questionaire')
       : back()->with('error','couldnt delete this questionaire')
       ;
    }
}