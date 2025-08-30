@extends('layout.main')
@section('title','Your Resources')
@push('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }
        .resource-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .resource-card:hover .resource-actions {
            opacity: 1;
        }
        .file-pdf { background-color: #fee2e2; color: #dc2626; }
        .file-csv { background-color: #dbeafe; color: #2563eb; }
        .file-img { background-color: #dcfce7; color: #16a34a; }
        .file-doc { background-color: #ede9fe; color: #7e22ce; }
        .file-zip { background-color: #ffedd5; color: #ea580c; }
        .sidebar-item.active {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            color: #1d4ed8;
            font-weight: 500;
        }
        .progress-bar {
            height: 6px;
            border-radius: 3px;
        }
        .storage-card {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: white;
        }
        .dropzone {
            border: 2px dashed #d1d5db;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }
        .dropzone.active {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }
    </style>
@endpush
@section('main')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row gap-8">
        <!-- Sidebar -->
        <div class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                <a href="{{route('create.resources')}}" class="w-full mb-4 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center">
                    <i class="fas fa-cloud-upload-alt mr-2"></i> Create Resource
                </a>
                
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
<i class="fas fa-archive text-gray-500 mr-2"></i> Institutions
                </h3>
                <ul class="space-y-1 mb-6">
                    <li>
                        <a href="{{route('pages.manage.resources')}}" class="sidebar-item flex items-center px-3 py-2 rounded-lg @if(!$_GET) active @endif">
                            <i class="fas fa-box-open mr-2"></i> All Resources
                            <span class="ml-auto text-gray-500">{{$all}}</span>
                        </a>
                    </li>
                    @foreach ($systems as $system)
                    <li>
                        <a href="?system={{$system->name}}" class="sidebar-item flex items-center px-3 py-2 rounded-lg @if($_GET && $_GET['system'] === $system->name) active @endif">
                            <i class="fas fa-box-open mr-2"></i> {{Ucwords($system->name)}}
                            @if ($_GET && $_GET['system'] === $system->name)              
                            <span class="ml-auto text-gray-500">{{count($resources)}}</span>
                            @endif
                        </a>
                    </li>
                    @endforeach
                </ul>
                
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-filter text-gray-500 mr-2"></i> File Types Available
                </h3>
                <ul class="space-y-2">
                    <li class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 cursor-pointer">
                        <div class="h-6 w-6 rounded-full flex items-center justify-center file-pdf mr-2">
                            <i class="fas fa-file-pdf text-xs"></i>
                        </div>
                        PDF Documents
                    </li>
                    <li class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 cursor-pointer">
                        <div class="h-6 w-6 rounded-full flex items-center justify-center file-csv mr-2">
                            <i class="fas fa-file-csv text-xs"></i>
                        </div>
                        CSV Spreadsheets
                    </li>
                    <li class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 cursor-pointer">
                        <div class="h-6 w-6 rounded-full flex items-center justify-center file-img mr-2">
                            <i class="fas fa-file-image text-xs"></i>
                        </div>
                        Images
                    </li>
                    <li class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 cursor-pointer">
                        <div class="h-6 w-6 rounded-full flex items-center justify-center file-doc mr-2">
                            <i class="fas fa-file-word text-xs"></i>
                        </div>
                        Documents
                    </li>
                    <li class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 cursor-pointer">
                        <div class="h-6 w-6 rounded-full flex items-center justify-center file-zip mr-2">
                            <i class="fas fa-file-archive text-xs"></i>
                        </div>
                        Archives
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header with Stats and Actions -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                    @if($_GET)
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-file-archive text-blue-500 mr-2"></i> {{Ucwords($_GET['system'])}} Resources
                        </h2>
                    @else
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-file-archive text-blue-500 mr-2"></i> All Resources
                        </h2>
                    @endif
                        <p class="text-gray-600">Your collection of research materials and datasets</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <input type="text" placeholder="Search resources..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-sort-amount-down"></i>
                        </button>
                        <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Storage Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="storage-card rounded-xl p-5 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-white">Storage Usage</h3>
                                <p class="text-blue-100">{{StorageUsed($resources)}} MB</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                                <i class="fas fa-database text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="w-full bg-white bg-opacity-20 rounded-full overflow-hidden">
                            <div class="progress-bar bg-white" style="width:{{StorageUsed($resources)/500 * 100}}%"></div>
                        </div>
                        <div class="flex justify-between text-sm text-blue-100 mt-2">
                            <span>{{StorageUsed($resources)}} MB used</span>
                            <span>{{500 - StorageUsed($resources)}} MB free</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-file text-blue-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-blue-600">Total Resources</div>
                                    <div class="font-bold text-gray-800">{{$TotalResources}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-cloud-upload-alt text-green-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-green-600">Uploaded Today</div>
                                    <div class="font-bold text-gray-800">{{$UploadedToday}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-users text-purple-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-purple-600">Institutional</div>
                                    <div class="font-bold text-gray-800">{{$resources->count()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- Resources Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($resources as $resource)
                    <x-resource-card 
                        name="{{ $resource->name }}"
                        size="{{ number_format(filesize(storage_path('app/public/files/'.$resource->filename))/1048576,3) }}"
                        details="{{ $resource->details}}"
                        uploaded_at="{{ $resource->created_at}}"
                        author="{{ username($resource->author)}}"
                        filetype="{{  strtoupper($resource->filetype) }}"
                        system="{{ SystemName($resource->system) }}"
                        filename="{{ $resource->filename }}"
                        id="{{ $resource->id }}"
                    />
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                <nav class="flex items-center gap-1">
                    <button class="h-10 w-10 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-100">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="h-10 w-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-medium">1</button>
                    <button class="h-10 w-10 rounded-full flex items-center justify-center text-gray-700 hover:bg-gray-100 font-medium">2</button>
                    <button class="h-10 w-10 rounded-full flex items-center justify-center text-gray-700 hover:bg-gray-100 font-medium">3</button>
                    <button class="h-10 w-10 rounded-full flex items-center justify-center text-gray-500">...</button>
                    <button class="h-10 w-10 rounded-full flex items-center justify-center text-gray-700 hover:bg-gray-100 font-medium">6</button>
                    <button class="h-10 w-10 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-100">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </nav>
            </div>
        </div>
    </div>    
@endsection