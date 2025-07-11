@extends('layout.main')
@section('title','Resources -'.$resource->name)
@push('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#1e40af',
                        accent: '#f59e0b',
                    }
                }
            }
        }
    </script>
    <style>
        .file-icon {
            transition: transform 0.3s ease;
        }
        .file-icon:hover {
            transform: scale(1.1);
        }
        .preview-container {
            transition: all 0.3s ease;
        }
        .file-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .action-btn:hover {
            transform: translateY(-2px);
        }
    </style>
@endpush
@section('main')
    <main class="max-w-6xl mx-auto p-4">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-600 mb-6 flex items-center">
            <a href="{{route('index')}}" class="text-primary hover:underline">Home</a>
            <span class="mx-2">/</span>
            <a href="#" class="text-primary hover:underline">Resources</a>
            <span class="mx-2">/</span>
            <span class="text-gray-500">{{$resource->name}}</span>
        </nav>

        <!-- Resource Header -->
        <div class="bg-white p-6 rounded-xl shadow-sm mb-8">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- File Icon -->
                <div class="flex-shrink-0">
                    <div class="file-icon w-24 h-24 rounded-lg bg-red-50 flex items-center justify-center">
                        <i class="fas fa-file-pdf text-5xl text-red-500"></i>
                    </div>
                </div>

                <!-- File Details -->
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{$resource->name}}</h1>
                    <p class="text-gray-700 mb-4">{{Str::limit($resource->details,200)}}...</p>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">File Type</p>
                            <p class="font-medium">{{$resource->filetype}}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">File Size</p>
                            @php
                            // {{filesize(asset('storage/files/'.$resource->filename))}}
                                $file = storage_path('app/public/files/'.$resource->filename);
                                $filesize = (file_exists($file)) ? round(filesize($file)/1048576) : null;
                            @endphp
                            <p class="font-medium">{{$filesize}} MB</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Uploaded</p>
                            <p class="font-medium">{{$resource->created_at}}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Author</p>
                            <p class="font-medium">{{username($resource->author)}}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{route('download',['filename'=>$resource->filename])}}" class="action-btn bg-primary hover:bg-secondary px-5 py-2.5 rounded-lg font-medium flex items-center">
                            <i class="fas fa-download mr-2"></i> Download
                        </a>
                        <button class="action-btn bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg font-medium flex items-center">
                            <i class="fas fa-share-alt mr-2"></i> Share
                        </button>
                        <button class="action-btn bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg font-medium flex items-center">
                            <i class="fas fa-bookmark mr-2"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Details Section -->
        <div class="bg-white p-6 rounded-xl shadow-sm mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle mr-2 text-primary"></i>
                Additional Information
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-medium text-gray-800 mb-3">Description</h3>
                    <p class="text-gray-700 mb-4">
                        {{$resource->details}}
                    </p>

                    <h3 class="font-medium text-gray-800 mb-3">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Climate Data</span>
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Historical Analysis</span>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Environmental Research</span>
                        <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">Meteorology</span>
                        <span class="bg-pink-100 text-pink-800 text-xs font-medium px-2.5 py-0.5 rounded">Sustainability</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Resources -->
        {{-- <div class="bg-white p-6 rounded-xl shadow-sm">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-link mr-2 text-primary"></i>
                Related Resources
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Resource Card 1 -->
                <div class="file-card bg-white border border-gray-200 rounded-lg p-4 hover:border-primary transition-all">
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-md bg-blue-50 flex items-center justify-center mr-4">
                            <i class="fas fa-file-excel text-xl text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900 mb-1">Climate Data 2020 (CSV)</h3>
                            <p class="text-sm text-gray-600 mb-2">Raw climate data for 2020</p>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>CSV • 8.2 MB</span>
                                <span>2023-07-22</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resource Card 2 -->
                <div class="file-card bg-white border border-gray-200 rounded-lg p-4 hover:border-primary transition-all">
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-md bg-blue-50 flex items-center justify-center mr-4">
                            <i class="fas fa-file-word text-xl text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900 mb-1">Research Methodology</h3>
                            <p class="text-sm text-gray-600 mb-2">Climate study methodologies</p>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>DOCX • 3.1 MB</span>
                                <span>2023-08-30</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resource Card 3 -->
                <div class="file-card bg-white border border-gray-200 rounded-lg p-4 hover:border-primary transition-all">
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-md bg-blue-50 flex items-center justify-center mr-4">
                            <i class="fas fa-file-pdf text-xl text-red-500"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900 mb-1">2023 Climate Projections</h3>
                            <p class="text-sm text-gray-600 mb-2">Future climate predictions</p>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>PDF • 12.4 MB</span>
                                <span>2023-10-05</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </main>
@endsection
@push('scripts')

@endpush
