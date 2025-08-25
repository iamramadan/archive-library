@extends('layout.entry')
@section('title', 'Confirm-Delete')
@section('heading', 'Confirm Delete Of '.$table)
@php
    $action = ['institution'=>'delete.system','note'=>'delete.note','resources'=>'delete.resources','questionaire'=>'delete.questionaire'];
@endphp
@section('main')
    <main class="max-w-3xl mx-auto p-4">
        <div class="bg-white rounded-lg shadow-sm p-6 text-center">
            <div class="text-red-600 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Delete Item</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this {{$table}}</p>
            <form action="{{route($action[$table])}}" method="post">
            @method('DELETE')
            @csrf
            <input name="id" value="{{$id}}" type="hidden"/>
            <div class="flex justify-center space-x-4">
                <a href="#" class="px-6 py-2 text-gray-600 hover:text-gray-800">Cancel</a>
                <button class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                    Confirm Delete
                </button>
            </div>
            </form>
        </div>
    </main>
@endsection