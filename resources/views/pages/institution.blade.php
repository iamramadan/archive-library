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
                    <p class="text-gray-600 mt-2">{{Str::limit($institute->about,200)}}</p>
                    
<div class="flex gap-4 mt-4 text-sm text-gray-500">
    <span class="flex items-center gap-1">
        <i data-lucide="edit-3" class="w-4 h-4"></i> {{ $institute->note_count }}
    </span>
    <span class="flex items-center gap-1">
        <i data-lucide="file-text" class="w-4 h-4"></i> {{ $institute->resources_count }}
    </span>
    <span class="flex items-center gap-1">
        <i data-lucide="clipboard-list" class="w-4 h-4"></i> {{ $institute->questionaires_count }}
    </span>
</div>
                </div>
            </div>
        </div>
    </div>
    @livewire('content-toggler', ['InstitutionId' => $institute->id])
@endsection
@push('scripts')
    <script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
@endpush