<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\System;
use App\Models\Resources;
use Illuminate\Http\Request;
use App\Models\Questionaires;
use Illuminate\Support\Facades\Auth;
use App\Models\Scopes\ContributableSystems;

class SearchController extends Controller
{
    public function index($query){
        $query = str_replace("?", "", $query);
        $systems = System::withoutGlobalScope(new ContributableSystems())
        ->WhereIn('id',Auth::user()->Ticket()->pluck('system')->toArray())
        ->orWhere('creator',Auth::user()->id)
        ->pluck('id')
        ->toArray();

        $notes = (count($systems) > 0) ? Note::where('title','like','%'.$query.'%')
                ->orWhere('body','like','%'.$query.'%')
                ->whereIn('system', $systems)
                ->paginate(10)
                ->toArray() : ['data'=>[]];
        $questionaires = (count($systems) > 0) ? Questionaires::where('name','like','%'.$query.'%')
        ->WhereIn('system',$systems)
        ->paginate(10)
        ->toArray() : ['data'=>[]];
        $resources = (count($systems) > 0) ? Resources::where('name','like','%'.$query.'%')
        ->orWhere('details','like','%'.$query.'%')
        ->WhereIn('system',$systems)
        ->paginate(10)
        ->toArray() : ['data'=>[]];
        // dd($notes);
        $all = collect($notes)->take(2)
        ->concat(collect($questionaires)->take(2))
        ->concat(collect($resources)->take(2));
    return view('search.results',compact(['all','notes','resources','questionaires','query']));
    }
}
