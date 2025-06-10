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
    public function institution($name){
        $institute = System::withoutGlobalScope(new ContributableSystems)->withCount(['resources','note','questionaires'])->where('name',$name)->first();
        return view('pages.institution',compact('institute'));
    }
    public function managecontent(){
        $note = Note::where('author',Auth::user()->id)->paginate(4);
        $resources = Resources::where('author',Auth::user()->id)->paginate(4);
        $questionaires = Questionaires::where('author',Auth::user()->id)->paginate(4);
        $system = System::paginate(5);
        return view('pages.managecontent',compact(['note','resources','questionaires','system']));
    }
}
