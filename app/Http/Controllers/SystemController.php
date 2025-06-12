<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public  function CreateSystemPage(){
        return view('create.system');
    }
    public function updatepage($id){
        $institute = System::find($id);
        return view('update.system',compact(['institute']));
    }
    public function addlogo($id){
        $systemId = $id;
        $system = System::find($id);
        return view('create.systemlogo',compact(['systemId','system']));
    }
    public function store(Request $request)
{
    $validationArray = ($request->id == 'newentry') ?
     ['creator' => 'required','name' => 'required|max:50|unique:systems,name','about' => 'required|max:500'] 
     :
     ['creator' => 'required','name' => 'required|max:50','about' => 'required|max:500'];
    $data = $request->validate($validationArray);
        if ($request->id === 'newentry') {
            $system = System::create($data);
            return redirect()->route('create.systemlogo',['id'=> $system->id]);
        } else {
           $system = System::updateOrCreate(['id' => $request->id], $data);
           return redirect()->route('pages.myInstitutions');
        }
}

public function UpdateLogo(Request $request){
    $request->validate([
        'id'=>'required',
        'logo' => 'required|image|mimes:jpg,jpeg,png,webp',
    ]);
    $System = System::find($request->id);
    $System->update([
        'logo' => upload($request->logo)
    ]);

     return redirect()->route('pages.myInstitutions');
}
public function delete(Request $request){
    $system = System::find($request->id);
    $system->forceDelete();
    return redirect()->route('pages.myInstitutions');
}
}
