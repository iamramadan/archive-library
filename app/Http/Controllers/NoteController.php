<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function CreateNotesPage(){
        $AvailableSystems = System::all();
        return view('create.notes',compact('AvailableSystems'));
    }
    public function store(Request $request){
        $data = $this->validate($request,[
            'author'=>'required',
            'system'=>'required',
            'title'=>'max:100|required',
            'body'=>'required|min:50',
            'image'=>'mimes:png,jpeg,jpg|max:10000'
    ]);
    // dd($data);
        if($request->hasFile('image')){
            $data['image'] = upload($request->logo);
        }
        $note = Note::createIfContributor($data,$request->system,Auth::user());
        if (!$note) {
            return back()->with('message','You are not a contributor to this institution.');
        }
        return redirect()->route('pages.note',['id'=>$note->id]);
    }
    public function update(Request $request){
        $IncomingField = $this->validate($request,[
            'id'=>'required',
            'author'=>'required',
            'system'=>'required',
            'title'=>'required|max:100',
            'body'=>'required|min:50',
            'image'=>'mimes:png,jpeg,jpg'
        ]);
        if($request->hasFile('image')){
            $IncomingField['image'] = upload($request->logo);
        }
        unset($IncomingField['id']);
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
