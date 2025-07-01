<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function CreateQuestions($id){
        return view('create.questions',compact( ['id']));
    }
}
