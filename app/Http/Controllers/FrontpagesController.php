<?php

namespace App\Http\Controllers;
use App\Models\System;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FrontpagesController extends Controller
{
    public function index(){
        return view('index');
    }
    public function myInstitutions(){
        $institutionsData = System::withCount(['resources','questionaires','note'])->where('creator', Auth::user()->id)->get();
        return view('pages.UserSystems',compact(['institutionsData']));
    }
}
