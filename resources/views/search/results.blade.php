@extends('layout.main')
@section('title','search results for')
@section('main')
    @livewire('search-results',['results'=> ['notes'=>$notes,
                                'questionaires'=>$questionaires,
                                'all'=>$all,
                                'resources'=>$resources
                                ]])
@endsection