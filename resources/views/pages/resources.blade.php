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
            <a href="#" class="text-primary hover:underline">Home</a>
            <span class="mx-2">/</span>
            <a href="#" class="text-primary hover:underline">Resources</a>
            <span class="mx-2">/</span>
            <span class="text-gray-500">Historical Climate Data Report</span>
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
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Historical Climate Data Report</h1>
                    <p class="text-gray-700 mb-4">Comprehensive analysis of climate patterns from 1950 to 2020 with detailed regional breakdowns and future projections.</p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">File Type</p>
                            <p class="font-medium">PDF Document</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">File Size</p>
                            <p class="font-medium">24.8 MB</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Uploaded</p>
                            <p class="font-medium">2023-09-15</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Author</p>
                            <p class="font-medium">Dr. Emma Richardson</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-3">
                        <button class="action-btn bg-primary hover:bg-secondary text-white px-5 py-2.5 rounded-lg font-medium flex items-center">
                            <i class="fas fa-download mr-2"></i> Download
                        </button>
                        <button class="action-btn bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg font-medium flex items-center">
                            <i class="fas fa-share-alt mr-2"></i> Share
                        </button>
                        <button class="action-btn bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg font-medium flex items-center">
                            <i class="fas fa-bookmark mr-2"></i> Save
                        </button>
                        <button class="action-btn bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg font-medium flex items-center">
                            <i class="fas fa-print mr-2"></i> Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Preview Section -->
        <div class="bg-white p-6 rounded-xl shadow-sm mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-eye mr-2 text-primary"></i>
                Document Preview
            </h2>
            
            <div class="preview-container border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 min-h-[500px] flex flex-col items-center justify-center p-8">
                <div class="text-center">
                    <i class="fas fa-file-pdf text-6xl text-red-500 mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-800 mb-2">Historical Climate Data Report</h3>
                    <p class="text-gray-600 mb-6">Preview unavailable for this file type. Download to view the full document.</p>
                    <button class="bg-primary hover:bg-secondary text-white px-5 py-2.5 rounded-lg font-medium">
                        Download Full Document
                    </button>
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
                        This comprehensive report provides detailed historical climate data analysis from 1950 to 2020. 
                        It includes regional breakdowns, temperature anomaly analysis, precipitation trends, and extreme 
                        weather event documentation. The report also contains projections for future climate patterns 
                        based on current trends.
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
                
                <div>
                    <h3 class="font-medium text-gray-800 mb-3">Technical Details</h3>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex">
                            <i class="fas fa-file-alt text-primary mt-1 mr-3"></i>
                            <span>Number of Pages: 124</span>
                        </li>
                        <li class="flex">
                            <i class="fas fa-chart-bar text-primary mt-1 mr-3"></i>
                            <span>Contains 24 charts and 18 data tables</span>
                        </li>
                        <li class="flex">
                            <i class="fas fa-database text-primary mt-1 mr-3"></i>
                            <span>Data sources: NOAA, NASA, WMO, IPCC</span>
                        </li>
                        <li class="flex">
                            <i class="fas fa-lock text-primary mt-1 mr-3"></i>
                            <span>Security: Public Access</span>
                        </li>
                        <li class="flex">
                            <i class="fas fa-code text-primary mt-1 mr-3"></i>
                            <span>Version: 2.1.4</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Related Resources -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
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
        </div>
    </main>
@endsection
@push('scripts')
    
@endpush