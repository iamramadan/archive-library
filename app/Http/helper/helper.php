<?php
use App\Models\User;
use App\Models\System;

function upload($file){
        $filename = md5($file->getClientOriginalName())."_".time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/files',$filename);
        return $filename;
}
function username($id){
  return User::find($id)->value('username');
}
function SystemName($id){
  return System::where('id',$id)->get('name')->value('name') ;
}
function fileTypeIcon($name){
    $name = match ($name) {
        'pdf' => 'fa-file-pdf',
    };
    return $name;
}
