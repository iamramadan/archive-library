<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use App\Models\System;
use App\Models\Questionaires;
use App\Models\Resources;

class SearchController extends Controller
{
    public function index($query){
        $query = str_replace("?", "", $query);
        $systems = System::where('creator',Auth::user()->id)
        ->whereIn('id',Auth::user()->Ticket()->get()->toArray())
        ->get('id')->toArray();
        $notes = Note::where('title',$query)->orWhere('body',$query)->orWhere('system',$systems)->get()->toArray();
        $questionaires = Questionaires::where('name',$query)->orWhere('system',$systems)->get()->toArray();
        $resources = Resources::where('name',$query)->orWhere('details',$query)->orWhere('system',$systems)->get()->toArray();
        // dd($notes);
        $all = collect($notes)->take(2)
        ->concat(collect($questionaires)->take(2))
        ->concat(collect($resources)->take(2));
    return view('search.results',compact(['all','notes','resources','questionaires']));
    }
}
