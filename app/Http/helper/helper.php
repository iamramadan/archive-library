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
    $name = match (strtolower($name)) {
        'pdf'               => 'fa-file-pdf',
        'doc', 'docx'       => 'fa-file-word',
        'xls', 'xlsx', 'csv'=> 'fa-file-excel',
        'txt', 'rtf'        => 'fa-file-lines',
        'mp3', 'wav', 'aac' => 'fa-file-audio',
        'mp4', 'avi', 'mov', 'mkv', 'webm' => 'fa-file-video',
        'epub'              => 'fa-book',
        'zip', 'rar'        => 'fa-file-zipper',
        'jpg', 'jpeg', 'png', 'gif', 'svg' => 'fa-file-image',
        default             => 'fa-file',
    };
    return $name;
}
function StorageUsed($resources){
  if ($resources->count() == 0) return 0;
  $size = 0;
  foreach ($resources as $resource) {
    $size += round(filesize(storage_path('app/public/files/'.$resource->filename))/1048576);
  }
  return $size;
}
function ArcCode() {
    do {
        $digits = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT) .
                  str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $formatted = substr($digits, 0, 4) . '-' . substr($digits, 4, 4);
        $code = 'ARC-' . $formatted;

    } while (\App\Models\Ticket::where('token', $code)->exists());

    return $code;
}
