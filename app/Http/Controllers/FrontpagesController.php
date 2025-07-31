<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\System;
use App\Models\Resources;
use Illuminate\Http\Request;
use App\Models\Questionaires;
use Illuminate\Support\Facades\Auth;
use App\Models\Scopes\ContributableSystems;

class FrontpagesController extends Controller
{
    public function index(){
        return view('index');
    }
    public function myInstitutions(){
        $institutionsData = System::withoutGlobalScope(new ContributableSystems())->withCount(['resources','questionaires','note'])->where('creator', Auth::user()->id)->get();
        return view('pages.UserSystems',compact(['institutionsData']));
    }
    public function note($id){
        $note = Note::find($id);
        return view('pages.note',compact('note'));
    }
    public function resources($id){
        $resource = Resources::find($id);
        return view('pages.resources',compact('resource'));
    }
    public function institution($name){
        $institute = System::withoutGlobalScope(new ContributableSystems)->withCount(['resources','note','questionaires'])->where('name',$name)->first();
        return view('pages.institution',compact('institute'));
    }
    public function managecontent(){
        $notes = Note::where('author',Auth::user()->id)->paginate(4);
        $resources = Resources::where('author',Auth::user()->id)->paginate(4);
        $questionaires = Questionaires::where('author',Auth::user()->id)->paginate(4);
        $systems = System::paginate(5);
        return view('pages.manage.managecontent',compact(['notes','resources','questionaires','systems']));
    }
    public function questionaire($id){
        $questionaires = Questionaires::with('questions')->where('id',$id)->first();
        return view('pages.questionaire',compact('questionaires'));
    }
    public function QuestionResult($id){
            // questionaire with question and result
        $questionaireResult = Questionaires::with(
        ['result'=>function($query){
                $query->where('user',Auth::user()->id);
                },'questions'
        ])->find($id);
        return view('pages.result',compact('questionaireResult'));
    }
}
