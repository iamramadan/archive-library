<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Questionaires;
use App\Models\Resources;

class SearchController extends Controller
{
    public function index($query){
        $notes = Note::where('title',$query)->orwhere('body',$query)->paginate();
        $questionaires = Questionaires::where('name',$query)->paginate();
        $resources = Resources::where('name',$query)->orwhere('details',$query)->paginate();
        $all = collect($notes)->take(2)
        ->concat(collect($questionaires)->take(2))
        ->concat(collect($resources)->take(2));
    return view('search.results',compact(['all','notes','resources','questionaires']));
    }
}
