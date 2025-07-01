<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourcesController extends Controller
{
    public function show(){
        $resources = ($_GET)
        ? Resources::where('author',Auth::user()->id)->where('system',System::where('name',$_GET['system'])->value('id'))->get()
        : Resources::where('author',Auth::user()->id)->get();
        $systems = System::all();
        $TotalResources = Resources::count();
        $UploadedToday = Resources::where('created_at','>',now()->startOfDay())->count();
        return view('pages.manage.resources',compact(['systems','resources','TotalResources','UploadedToday']));
    }
    public function CreateResourcesPage(){
        $AvailableSystems = System::all();
        return view('create.resources',compact(['AvailableSystems']));
    }
    public function UpdateStore(Request $request){
        $data  = $this->validate($request,[
           'name'=>'required|max:100|min:5',
           'author'=>'required',
           'system'=>'required',
           'filename' => 'required|mimes:doc,docx,pdf,mp4,avi,mov,mp3,wav,aac,epub,xls,xlsx,csv,txt,rtf|max:51200', // max: 50MB
           'details'=>'min:8|max:100'
        ]);
        $data['filetype'] = $request->filename->getClientOriginalExtension();
         if ($request->id != null) {
            $data['filename'] = upload($data['filename']);
            return Resources::where('id',$request->id)->update($data) ?
             back()->with('sucess','Updated Resource Successfully')
             : back()->with('error','Couldnt Update Resource');
         }
        $data['filename'] = upload($data['filename']);
        $resource = Resources::createIfContributor($data,$request->system,Auth::user());
        if (!$resource) {
            return back()->with('message','You are not a contributor');
        }
        return redirect()->route('pages.resources',['id'=>$resource->id]);
    }
    public function download($filename){
        $file_path = storage_path('app/public/files/'.$filename);
        if(!file_exists($file_path)){
            abort(404,'file doesnt exist');
        }
        return response()->download($file_path);
    }
    public function delete(Request $request){
    $resource = Resources::find($request->id);
    return $resource->delete() ? redirect()->route('') : redirect()->back();
    }
}
