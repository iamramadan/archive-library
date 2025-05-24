<?php

namespace App\Http\Controllers;
use App\Models\System;
use Illuminate\Http\Request;
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
        $institute = System::withoutGlobalScope(new ContributableSystems)->where('name',$name)->get();
        return view('pages.institution',compact('institute'));
    }
}
