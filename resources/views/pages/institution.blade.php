@extends('layout.main')
@section('title',$institute->name)
@section('main')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <div class="flex items-center gap-6">
                <div class="w-24 h-24 bg-blue-100 rounded-xl flex items-center justify-center text-4xl">
                    <x-image name="{{$institute->logo}}"/>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{$institute->name}}</h1>
                    <p class="text-gray-600 mt-2">{{$institute->about}}</p>
                    <div class="flex gap-4 mt-4 text-sm text-gray-500">
                        <span>📚 1,452 items</span>
                        <span>👥 245 members</span>
                        <span>📅 Established 2020</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('content-toggler', ['InstitutionId' => $institute->id])
@endsection