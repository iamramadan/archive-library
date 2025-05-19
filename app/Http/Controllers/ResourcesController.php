<?php

namespace App\Http\Controllers;

use App\Models\Resources;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    public function show($id){
        $Resources = Resources::find($id);
        return view('');
    }
    public function createResources(){
        
    }
}
