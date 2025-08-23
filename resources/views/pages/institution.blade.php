@extends('layout.main')
@section('title',$institute->name)
@section('main')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-gradient-to-br from-slate-50 via-white to-blue-50 rounded-2xl shadow-lg shadow-blue-100/20 p-8 sm:p-10">
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6 md:gap-8">
            <!-- Logo -->
            <div class="w-28 h-28 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-md shadow-blue-200/50 flex-shrink-0">
                <x-image name="{{ $institute->logo }}" class="w-16 h-16 object-contain" />
            </div>

            <!-- Text + Stats -->
            <div class="flex-1 space-y-3">
                <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-800 to-slate-600 tracking-tight">
                    {{ $institute->name }}
                </h1>

                <p class="text-slate-600 leading-relaxed max-w-2xl">
                    {{ Str::limit($institute->about, 200) }}
                </p>

                <!-- Stats -->
                <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-500 mt-5">
                    <span class="flex items-center gap-2 px-3 py-1.5 bg-slate-100/70 rounded-full">
                        <i data-lucide="edit-3" class="w-4 h-4 text-blue-500"></i>
                        <span class="font-medium">{{ $institute->note_count }} Notes</span>
                    </span>
                    <span class="flex items-center gap-2 px-3 py-1.5 bg-slate-100/70 rounded-full">
                        <i data-lucide="file-text" class="w-4 h-4 text-indigo-500"></i>
                        <span class="font-medium">{{ $institute->resources_count }} Resources</span>
                    </span>
                    <span class="flex items-center gap-2 px-3 py-1.5 bg-slate-100/70 rounded-full">
                        <i data-lucide="clipboard-list" class="w-4 h-4 text-purple-500"></i>
                        <span class="font-medium">{{ $institute->questionaires_count }} Questionnaires</span>
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