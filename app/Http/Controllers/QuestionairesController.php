<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;
use App\Models\Questionaires;
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
}
