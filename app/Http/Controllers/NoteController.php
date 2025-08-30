<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Scopes\ContributableSystems;
// use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function show(){
        $all = Note::where('author',Auth::user()->id)->count();
        $notes =  ($_GET) ?
         Note::where('author',Auth::user()->id)->where('system',System::where('name',$_GET['system'])->value('id'))->paginate(9)
         : Note::where('author',Auth::user()->id)->paginate(9);
        $systems = System::all();
        return view('pages.manage.note',compact(['all','notes','systems']));
    }
    public function CreateNotesPage(){
        $AvailableSystems = System::all();
        return view('create.notes',compact('AvailableSystems'));
    }
    public function UpdateNotesPage($id){
        $AvailableSystems = System::all();
        $note = Note::find($id);
        return view('update.note',compact('AvailableSystems','note'));
    }
    public function store(Request $request){
        $data = $this->validate($request,[
            'author'=>'required',
            'system'=>'required',
            'title'=>'max:100|required',
            'body'=>'required|min:50',
            'image'=>'mimes:png,jpeg,jpg|max:10000'
    ]);
        if($request->hasFile('image')){
            $data['image'] = upload($request->image);
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
        // dd($request);
        if($request->hasFile('image')){
            $IncomingField['image'] = upload($request->image);
        }
        unset($IncomingField['id']);
        $update = Note::where('id',$request->id)->update($IncomingField);
        if (!$update) {
            # code...
            return back()->with('message','Note Could Not Be Updated');
        }
        return back()->with('message','Note Updated Successfully');
    }
    public function delete(Request $request){
        Note::where('id',$request->id)->delete();
        return redirect()->route('pages.manage.notes')->with('success','Successfully Deleted Note');
    }
}
