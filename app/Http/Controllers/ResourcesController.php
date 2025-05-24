<?php

namespace App\Http\Controllers;

use App\Models\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourcesController extends Controller
{
    public function show($id){
        $Resources = Resources::find($id);
        return view('');
    }
    public function UpdateStore(Request $request){
        $data  = $this->validate($request,[
           'name'=>'required|max:100|min:5',
           'author'=>'required',
           'system'=>'required',
           'filename'=>'required|min:8|mimes:jpg,png,pdf,mp4,mkv,epub,wav,mp3',
           'details'=>'min:8|max:30' 
        ]);
         if ($request->id != null) {
            return Resources::where('id',$request->id)->update($data) ? back()->with('sucess','Updated Resource Successfully') : back()->with('error','Couldnt Update Resource');
         }
        $data['filename'] = upload($data['filename']);
        $resources = Resources::createIfContributor($data,$request->system,Auth::user());
        if (!$resources) {
            return back()->with('message','You are not a contributor');
        }
        return redirect()->route('');
    }
    public function delete(Request $request){
    $resource = Resources::find($request->id);
    return $resource->delete() ? redirect()->route('') : redirect()->back();
    }
}
