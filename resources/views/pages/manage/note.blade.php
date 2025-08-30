@extends('layout.main')
@section('title','Manage Notes')
@push('links')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
@endpush
@section('main')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row gap-8">
        <!-- Sidebar -->
        <div class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                <a href="{{route('create.note')}}" class="w-full mb-4 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i> New Note
                </a>

                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-folder text-gray-500 mr-2"></i> Collections
                </h3>
                <ul class="space-y-1 mb-6">
                    <li>
                        <a href="{{route('pages.manage.notes')}}" class="sidebar-item flex items-center px-3 py-2 rounded-lg active">
                            <i class="far fa-file-alt mr-2"></i> All Notes
                            <span class="ml-auto text-gray-500">{{$all}}</span>
                        </a>
                    </li>
                    @foreach ($systems as $system)
                    <li>
                        <a href="?system={{$system->name}}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-bookmark mr-2 text-blue-500"></i>{{$system->name}}
                        @isset($_GET['system'])
                        @if($system->name == $_GET['system'])
                            <span class="ml-auto text-gray-500">{{$notes->count()}}</span>
                        @endif
                        @endisset
                        </a>
                    </li>
                    @endforeach
                </ul>

                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-tags text-gray-500 mr-2"></i> Tags
                </h3>
                <div class="tag-cloud flex flex-wrap gap-2">
                    <span class="tag-research px-3 py-1 text-sm rounded-full cursor-pointer">Research</span>
                    <span class="tag-analysis px-3 py-1 text-sm rounded-full cursor-pointer">Analysis</span>
                    <span class="tag-methodology px-3 py-1 text-sm rounded-full cursor-pointer">Methodology</span>
                    <span class="tag-ideas px-3 py-1 text-sm rounded-full cursor-pointer">Ideas</span>
                    <span class="tag-reference px-3 py-1 text-sm rounded-full cursor-pointer">Reference</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header with Stats and Actions -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        @if (isset($_GET['system']))
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                            <i class="far fa-file-alt text-blue-500 mr-2">{{Ucwords($_GET['system'])}} Notes</i>
                        </h2>
                        <a class="text-gray-600" href="{{route('pages.institution',['name'=>$_GET['system']])}}">View Institution</a>
                        @else
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                            <i class="far fa-file-alt text-blue-500 mr-2"></i> <p>All Notes</p>
                        </h2>
                        <p class="text-gray-600">Your collection of notes for various institutions</p>
                        @endif
                    </div>
                    {{-- <div class="flex items-center space-x-3">
                        <div class="relative">
                            <input type="text" placeholder="Search notes..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-sort-amount-down"></i>
                        </button>
                        <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div> --}}
                </div>

                <div class="flex flex-wrap gap-4 mt-6">
                    <div class="flex items-center px-4 py-2 bg-blue-50 rounded-lg">
                        <div class="text-blue-600 mr-2">
                            <i class="far fa-file-alt"></i>
                        </div>
                        <div>
                            <div class="text-sm text-blue-600">Total Notes</div>
                            <div class="font-bold text-gray-800">{{$notes->count()}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes Grid -->
                @forelse($notes as $note)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <x-note-card
                                title="{{ $note->title }}"
                                body="{!! $note->body !!}"
                                system="{{ ucwords(SystemName($note->system)) }}"
                                id="{{ $note->id }}"
                                created_at="{{ $note->created_at->format('M d, Y') }}"
                                updated_at="{{ $note->updated_at->format('M d, Y') }}"
                            />
                    </div>

                @empty
                        <div class="flex justify-center mt-8 mb-4">
                            <a href="{{ route('create.note') }}"
                            class="flex items-center gap-2 text-blue-600 hover:bg-blue-100 hover:text-blue-700 font-semibold py-2 px-6 rounded-lg transition duration-200 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 4c.552 0 1 .448 1 1v6h6c.552 0 1 .448 1 1s-.448 1-1 1h-6v6c0 .552-.448 1-1 1s-1-.448-1-1v-6H5c-.552 0-1-.448-1-1s.448-1 1-1h6V5c0-.552.448-1 1-1z"/>
                                </svg>
                                <span>Create Note</span>
                            </a>
                        </div>

                @endforelse

            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                {{$notes->links()}}
            </div>
        </div>
    </div>
@endsection
