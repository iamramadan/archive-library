@extends('layout.main')
@section('title',$note->title)
@section('main')
    <main class="max-w-3xl mx-auto p-4 space-y-8">
        <!-- Back Navigation -->
        <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Notes
        </a>

        <!-- Note Container -->
        <div class="bg-white rounded-lg shadow-sm">
            <!-- Title Section -->
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                   {{$note->title}}
                </h1>
                <div class="flex items-center text-sm text-gray-500 space-x-4">
                    <span>Last updated: {{ $note->updated_at->format('d M Y') }}</span>
                    <span>•</span>
                    <span>Category: Urban Studies</span>
                </div>
            </div>

            <!-- Image Section -->
            <div class="p-6 bg-gray-50">
                <x-image name="{{$note->image}}"  
                     class="w-full h-96 object-cover rounded-lg"/>
            </div>

            <!-- Body Content -->
            <div class="p-6 prose max-w-none">
                {!!$note->body!!}
            </div>

            <!-- Metadata Footer -->
            <div class="p-6 border-t border-gray-200 text-sm text-gray-500">
                <div class="flex space-x-4">
                    <span>Author: {{username($note->author)}}</span>
                    <span>•</span>
                    <span>Tags: urbanism, european-history, architecture</span>
                </div>
            </div>
        </div>
    </main>
@endsection