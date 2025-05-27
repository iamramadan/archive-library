<?php
use App\Models\User;

function upload($file){
        $filename = md5($file->getClientOriginalName())."_".time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/files',$filename);
        return $filename;
}
function username($id){
  return User::find($id)->value('name');
}