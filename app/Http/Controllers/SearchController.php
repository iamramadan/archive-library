<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\System;
use App\Models\Resources;
use Illuminate\Http\Request;
use App\Models\Questionaires;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index($query){
        $query = str_replace("?", "", $query);
        $systems = System::where('creator',Auth::user()->id)
        ->orWhereIn('id',Auth::user()->Ticket()->pluck('system')->toArray())
        ->get('id')->toArray();
        $notes = Note::where('title','like','%'.$query.'%')
                ->orWhere('body','like','%'.$query.'%')
                ->whereIn('system', $systems)
                ->paginate(10)
                ->toArray() ?? [];
        $questionaires = Questionaires::where('name','like','%'.$query.'%')
        ->WhereIn('system',$systems)
        ->paginate(10)
        ->toArray() ?? [];
        $resources = Resources::where('name','like','%'.$query.'%')
        ->orWhere('details','like','%'.$query.'%')
        ->WhereIn('system',$systems)
        ->paginate(10)
        ->toArray() ?? [];
        // dd($notes);
        $all = collect($notes)->take(2)
        ->concat(collect($questionaires)->take(2))
        ->concat(collect($resources)->take(2));
    return view('search.results',compact(['all','notes','resources','questionaires','query']));
    }
}
