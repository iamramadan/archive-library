@extends('layout.entry')
@section('title','Create Questionaires')
@section('heading','Create Questionaires')
@section('main')
    <main class="max-w-3xl mx-auto p-4">
        @livewire('create-questions',['id'=>$id])
    </main>
@endsection
