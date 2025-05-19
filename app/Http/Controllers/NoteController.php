<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index($id){
        $note = Note::find($id);
        return view('pages.note',compact('note'));
    }
    public function store(Request $request){
        $IncomingField = $this->validate($request,[
            'author'=>'required',
            'system'=>'required',
            'title'=>'max:100|required',
            'body'=>'required|min:100',
            'logo'=>'mimes:png,jpeg,jpg'
    ]);
        if($request->hasFile('logo')){
            $IncomingField['logo'] = upload($request->logo);
        }
        Note::createIfContributor($IncomingField,$request->system,Auth::user());
        return back();
    }
    public function update(Request $request){
        $IncomingField = $this->validate($request,[
            'id'=>'required',
            'author'=>'required',
            'system'=>'required',
            'title'=>'max:100',
            'body'=>'min:100',
            'logo'=>'mimes:png,jpeg,jpg'
        ]);
        if($request->hasFile('logo')){
            $IncomingField['logo'] = upload($request->logo);
        }
        array_shift($IncomingField);
        $update = Note::where('id',$request->id)->update($IncomingField);
        if (!$update) {
            # code...
            return back()->with('error','Note Could Not Be Updated');
        }

        return back()->with('success','Note Updated Successfully');
    }
    public function delete($id){
        Note::where('id',$id)->delete();
        return back()->with('success','Successfully Deleted Message');
    }
}
