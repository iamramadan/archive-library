@extends('layout.main')
@section('title','Manage Notes')
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
                        <a href="?all" class="sidebar-item flex items-center px-3 py-2 rounded-lg active">
                            <i class="far fa-file-alt mr-2"></i> All Notes
                            <span class="ml-auto text-gray-500">{{$notes->count()}}</span>
                        </a>
                    </li>
                    @foreach ($systems as $system)
                        
                    @endforeach
                    <li>
                        <a href="" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-bookmark mr-2 text-blue-500"></i> Research Papers
                            <span class="ml-auto text-gray-500">12</span>
                        </a>
                    </li>
                    
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
            
            <div class="bg-white rounded-xl shadow-sm p-4">
                <h3 class="font-semibold text-gray-800 mb-3">Recent Activity</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-edit text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-700">You updated <span class="font-medium">Urban Development Patterns</span></div>
                            <div class="text-xs text-gray-500 mt-1">2 hours ago</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-plus text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-700">You created <span class="font-medium">Digital Preservation Techniques</span></div>
                            <div class="text-xs text-gray-500 mt-1">Yesterday</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-tag text-purple-600 text-sm"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-700">You tagged <span class="font-medium">Medieval Architecture</span> as Analysis</div>
                            <div class="text-xs text-gray-500 mt-1">2 days ago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header with Stats and Actions -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                            <i class="far fa-file-alt text-blue-500 mr-2"></i> Research Notes
                        </h2>
                        <p class="text-gray-600">Your collection of research notes and insights</p>
                    </div>
                    <div class="flex items-center space-x-3">
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
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-4 mt-6">
                    <div class="flex items-center px-4 py-2 bg-blue-50 rounded-lg">
                        <div class="text-blue-600 mr-2">
                            <i class="far fa-file-alt"></i>
                        </div>
                        <div>
                            <div class="text-sm text-blue-600">Total Notes</div>
                            <div class="font-bold text-gray-800">42</div>
                        </div>
                    </div>
                    <div class="flex items-center px-4 py-2 bg-green-50 rounded-lg">
                        <div class="text-green-600 mr-2">
                            <i class="fas fa-pen"></i>
                        </div>
                        <div>
                            <div class="text-sm text-green-600">Updated Today</div>
                            <div class="font-bold text-gray-800">3</div>
                        </div>
                    </div>
                    <div class="flex items-center px-4 py-2 bg-purple-50 rounded-lg">
                        <div class="text-purple-600 mr-2">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div>
                            <div class="text-sm text-purple-600">Tagged</div>
                            <div class="font-bold text-gray-800">28</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Notes Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Note Card 1 -->
                <div class="note-card bg-white rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="tag-research px-3 py-1 text-xs font-medium rounded-full">Research</span>
                                    <span class="text-xs text-gray-500"><i class="far fa-clock mr-1"></i> Updated: 2023-10-25</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-3">Urban Development Patterns</h3>
                                <p class="note-content text-gray-600 text-sm mb-4">
                                    Analysis of 20th century urban expansion in European cities with focus on post-war reconstruction efforts and modern planning principles. Includes case studies of Berlin, Warsaw, and Rotterdam.
                                </p>
                            </div>
                            <div class="note-actions opacity-0 transition-opacity flex space-x-1">
                                <button class="p-2 text-blue-500 hover:bg-blue-100 rounded-full">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="p-2 text-red-500 hover:bg-red-100 rounded-full">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                <i class="far fa-file-alt mr-1"></i> 1,240 words
                            </div>
                            <div>
                                <i class="far fa-bookmark mr-1"></i> Research Papers
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3 text-xs text-gray-500 flex justify-between items-center">
                        <span>Created: 2023-08-15</span>
                        <button class="text-blue-600 hover:text-blue-700 font-medium">
                            View Details <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Note Card 2 -->
                <div class="note-card bg-white rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="tag-analysis px-3 py-1 text-xs font-medium rounded-full">Analysis</span>
                                    <span class="text-xs text-gray-500"><i class="far fa-clock mr-1"></i> Updated: 2023-10-24</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-3">Medieval Architecture Comparison</h3>
                                <p class="note-content text-gray-600 text-sm mb-4">
                                    Detailed comparison between Gothic cathedrals in France and England, focusing on structural innovations and regional stylistic differences. Examines Notre-Dame, Chartres, Salisbury, and York Minster.
                                </p>
                            </div>
                            <div class="note-actions opacity-0 transition-opacity flex space-x-1">
                                <button class="p-2 text-blue-500 hover:bg-blue-100 rounded-full">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="p-2 text-red-500 hover:bg-red-100 rounded-full">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                <i class="far fa-file-alt mr-1"></i> 2,150 words
                            </div>
                            <div>
                                <i class="far fa-bookmark mr-1"></i> Literature Review
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3 text-xs text-gray-500 flex justify-between items-center">
                        <span>Created: 2023-09-02</span>
                        <button class="text-blue-600 hover:text-blue-700 font-medium">
                            View Details <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Note Card 3 -->
                <div class="note-card bg-white rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="tag-methodology px-3 py-1 text-xs font-medium rounded-full">Methodology</span>
                                    <span class="text-xs text-gray-500"><i class="far fa-clock mr-1"></i> Updated: 2023-10-22</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-3">Digital Preservation Techniques</h3>
                                <p class="note-content text-gray-600 text-sm mb-4">
                                    Modern approaches to digital archiving, including format migration, emulation strategies, and blockchain verification methods. Comparison of long-term preservation frameworks and best practices.
                                </p>
                            </div>
                            <div class="note-actions opacity-0 transition-opacity flex space-x-1">
                                <button class="p-2 text-blue-500 hover:bg-blue-100 rounded-full">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="p-2 text-red-500 hover:bg-red-100 rounded-full">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                <i class="far fa-file-alt mr-1"></i> 3,420 words
                            </div>
                            <div>
                                <i class="far fa-bookmark mr-1"></i> Research Papers
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3 text-xs text-gray-500 flex justify-between items-center">
                        <span>Created: 2023-10-18</span>
                        <button class="text-blue-600 hover:text-blue-700 font-medium">
                            View Details <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Note Card 4 -->
                <div class="note-card bg-white rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="tag-ideas px-3 py-1 text-xs font-medium rounded-full">Ideas</span>
                                    <span class="text-xs text-gray-500"><i class="far fa-clock mr-1"></i> Updated: 2023-10-20</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-3">Sustainable Architecture Concepts</h3>
                                <p class="note-content text-gray-600 text-sm mb-4">
                                    Exploration of innovative sustainable building techniques and materials. Concepts include vertical forests, passive solar design, and biomimicry approaches inspired by natural systems.
                                </p>
                            </div>
                            <div class="note-actions opacity-0 transition-opacity flex space-x-1">
                                <button class="p-2 text-blue-500 hover:bg-blue-100 rounded-full">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="p-2 text-red-500 hover:bg-red-100 rounded-full">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                <i class="far fa-file-alt mr-1"></i> 890 words
                            </div>
                            <div>
                                <i class="far fa-bookmark mr-1"></i> Ideas & Concepts
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3 text-xs text-gray-500 flex justify-between items-center">
                        <span>Created: 2023-09-28</span>
                        <button class="text-blue-600 hover:text-blue-700 font-medium">
                            View Details <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Note Card 5 -->
                <div class="note-card bg-white rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="tag-reference px-3 py-1 text-xs font-medium rounded-full">Reference</span>
                                    <span class="text-xs text-gray-500"><i class="far fa-clock mr-1"></i> Updated: 2023-10-15</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-3">Historical Building Materials</h3>
                                <p class="note-content text-gray-600 text-sm mb-4">
                                    Comprehensive reference on traditional building materials including stone, timber, brick, and mortar. Covers regional variations, deterioration patterns, and conservation techniques.
                                </p>
                            </div>
                            <div class="note-actions opacity-0 transition-opacity flex space-x-1">
                                <button class="p-2 text-blue-500 hover:bg-blue-100 rounded-full">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="p-2 text-red-500 hover:bg-red-100 rounded-full">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                <i class="far fa-file-alt mr-1"></i> 4,210 words
                            </div>
                            <div>
                                <i class="far fa-bookmark mr-1"></i> Literature Review
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3 text-xs text-gray-500 flex justify-between items-center">
                        <span>Created: 2023-08-05</span>
                        <button class="text-blue-600 hover:text-blue-700 font-medium">
                            View Details <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Note Card 6 -->
                <div class="note-card bg-white rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="tag-research px-3 py-1 text-xs font-medium rounded-full">Research</span>
                                    <span class="text-xs text-gray-500"><i class="far fa-clock mr-1"></i> Updated: 2023-10-18</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-3">Urban Green Spaces Impact</h3>
                                <p class="note-content text-gray-600 text-sm mb-4">
                                    Research on the psychological and environmental impacts of urban green spaces. Analysis of case studies from Singapore, Copenhagen, and Vancouver measuring biodiversity and human wellbeing metrics.
                                </p>
                            </div>
                            <div class="note-actions opacity-0 transition-opacity flex space-x-1">
                                <button class="p-2 text-blue-500 hover:bg-blue-100 rounded-full">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="p-2 text-red-500 hover:bg-red-100 rounded-full">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                <i class="far fa-file-alt mr-1"></i> 2,780 words
                            </div>
                            <div>
                                <i class="far fa-bookmark mr-1"></i> Research Papers
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3 text-xs text-gray-500 flex justify-between items-center">
                        <span>Created: 2023-09-12</span>
                        <button class="text-blue-600 hover:text-blue-700 font-medium">
                            View Details <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
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