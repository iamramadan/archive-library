@extends('layout.main')
@push('links')
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }
        .note-card:hover .note-actions {
            opacity: 1;
        }
        .resource-card:hover .resource-actions {
            opacity: 1;
        }
        .questionnaire-card:hover .questionnaire-actions {
            opacity: 1;
        }
        .tab-active {
            border-bottom: 3px solid #3b82f6;
            color: #3b82f6;
            font-weight: 600;
        }
        .dropdown-menu {
            transition: all 0.3s ease;
            transform-origin: top right;
            transform: scale(0);
            opacity: 0;
        }
        .dropdown-menu.active {
            transform: scale(1);
            opacity: 1;
        }
    </style>
@endpush
@section('main')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Action Bar -->
        <div class="flex flex-wrap items-center justify-between mb-6 gap-4">
            <div class="flex items-center space-x-3">
                <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> New Note
                </button>
                <div class="relative">
                    <button class="px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg flex items-center">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                </div>
            </div>
            <div class="flex items-center">
                <div class="relative">
                    <input type="text" placeholder="Search notes..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
        </div>

        <!-- User Content Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Notes Column -->
            <div class="lg:col-span-2 space-y-4">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-sticky-note text-blue-500 mr-2"></i> Recent Notes
                        </h2>
                        <div class="flex space-x-2">
                            <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-th"></i>
                            </button>
                            <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Note Card 1 -->
                        <div class="note-card bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 p-4 rounded-lg hover:shadow-md transition-all cursor-pointer">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center mb-1">
                                        <h3 class="font-semibold text-gray-900 mr-2">Urban Development Patterns</h3>
                                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Research</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">Analysis of 20th century urban expansion in European cities with focus on post-war reconstruction efforts and modern planning principles...</p>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span><i class="far fa-clock mr-1"></i> Last updated: 2023-08-15</span>
                                        <span class="mx-2">•</span>
                                        <span><i class="far fa-file-alt mr-1"></i> 1,240 words</span>
                                    </div>
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
                        </div>
                        
                        <!-- Note Card 2 -->
                        <div class="note-card bg-gradient-to-br from-green-50 to-emerald-50 border border-green-100 p-4 rounded-lg hover:shadow-md transition-all cursor-pointer">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center mb-1">
                                        <h3 class="font-semibold text-gray-900 mr-2">Medieval Architecture Comparison</h3>
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Analysis</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">Detailed comparison between Gothic cathedrals in France and England, focusing on structural innovations and regional stylistic differences...</p>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span><i class="far fa-clock mr-1"></i> Last updated: 2023-09-02</span>
                                        <span class="mx-2">•</span>
                                        <span><i class="far fa-file-alt mr-1"></i> 2,150 words</span>
                                    </div>
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
                        </div>
                        
                        <!-- Note Card 3 -->
                        <div class="note-card bg-gradient-to-br from-purple-50 to-violet-50 border border-purple-100 p-4 rounded-lg hover:shadow-md transition-all cursor-pointer">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center mb-1">
                                        <h3 class="font-semibold text-gray-900 mr-2">Digital Preservation Techniques</h3>
                                        <span class="px-2 py-1 text-xs bg-purple-100 text-purple-800 rounded-full">Methodology</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">Modern approaches to digital archiving, including format migration, emulation strategies, and blockchain verification methods...</p>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span><i class="far fa-clock mr-1"></i> Last updated: 2023-10-18</span>
                                        <span class="mx-2">•</span>
                                        <span><i class="far fa-file-alt mr-1"></i> 3,420 words</span>
                                    </div>
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
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-between items-center">
                        <div class="text-sm text-gray-500">Showing 3 of 42 notes</div>
                        <button class="px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg flex items-center">
                            Load More Notes <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Resources Section -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-folder text-green-500 mr-2"></i> Recent Resources
                        </h2>
                        <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg flex items-center">
                            <i class="fas fa-plus mr-2"></i> Upload Resource
                        </button>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Resource Card 1 -->
                        <div class="resource-card bg-white border border-gray-200 p-4 rounded-lg hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-file-pdf text-blue-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-1">Climate Data 2022</h3>
                                        <p class="text-sm text-gray-600">Annual climate report with regional analysis</p>
                                        <div class="flex items-center text-xs text-gray-500 mt-1">
                                            <span>PDF • 8.4 MB</span>
                                            <span class="mx-2">•</span>
                                            <span><i class="far fa-clock mr-1"></i> Uploaded: 2023-07-22</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="resource-actions opacity-0 transition-opacity flex space-x-2">
                                    <button class="p-2 text-blue-500 hover:bg-blue-100 rounded-full">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-full">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                    <button class="p-2 text-red-500 hover:bg-red-100 rounded-full">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Resource Card 2 -->
                        <div class="resource-card bg-white border border-gray-200 p-4 rounded-lg hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 rounded-lg bg-purple-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-file-csv text-purple-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-1">Historical Demographics Dataset</h3>
                                        <p class="text-sm text-gray-600">Population statistics 1950-2020 for European cities</p>
                                        <div class="flex items-center text-xs text-gray-500 mt-1">
                                            <span>CSV • 4.2 MB</span>
                                            <span class="mx-2">•</span>
                                            <span><i class="far fa-clock mr-1"></i> Uploaded: 2023-09-10</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="resource-actions opacity-0 transition-opacity flex space-x-2">
                                    <button class="p-2 text-blue-500 hover:bg-blue-100 rounded-full">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-full">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                    <button class="p-2 text-red-500 hover:bg-red-100 rounded-full">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 text-center">
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium inline-flex items-center">
                            View All Resources <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
      <i class="fas fa-question-circle text-green-500 mr-2"></i> Recent Questionnaires
    </h2>
    <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg flex items-center">
      <i class="fas fa-plus mr-2"></i> Create Questionnaire
    </button>
  </div>

  <div class="space-y-4">
    <!-- Questionnaire Card 1 -->
    <div class="resource-card bg-white border border-gray-200 p-4 rounded-lg hover:shadow-md transition-all">
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <div class="h-12 w-12 rounded-lg bg-yellow-100 flex items-center justify-center mr-4">
            <i class="fas fa-clipboard-list text-yellow-600 text-xl"></i>
          </div>
          <div>
            <h3 class="font-medium text-gray-900 mb-1">Customer Feedback Form</h3>
            <p class="text-sm text-gray-600">10 questions on user satisfaction</p>
            <div class="flex items-center text-xs text-gray-500 mt-1">
              <span>Form • 220 responses</span>
              <span class="mx-2">•</span>
              <span><i class="far fa-clock mr-1"></i> Last updated: 2025-05-10</span>
            </div>
          </div>
        </div>
        <div class="resource-actions opacity-0 transition-opacity flex space-x-2">
          <button class="p-2 text-blue-500 hover:bg-blue-100 rounded-full" title="View Form">
            <i class="fas fa-eye"></i>
          </button>
          <button class="p-2 text-green-500 hover:bg-green-100 rounded-full" title="Edit Form">
            <i class="fas fa-edit"></i>
          </button>
          <button class="p-2 text-purple-500 hover:bg-purple-100 rounded-full" title="View Responses">
            <i class="fas fa-chart-bar"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Questionnaire Card 2 -->
    <div class="resource-card bg-white border border-gray-200 p-4 rounded-lg hover:shadow-md transition-all">
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <div class="h-12 w-12 rounded-lg bg-pink-100 flex items-center justify-center mr-4">
            <i class="fas fa-poll text-pink-600 text-xl"></i>
          </div>
          <div>
            <h3 class="font-medium text-gray-900 mb-1">Employee Engagement Survey</h3>
            <p class="text-sm text-gray-600">Quarterly staff feedback form</p>
            <div class="flex items-center text-xs text-gray-500 mt-1">
              <span>Survey • 130 responses</span>
              <span class="mx-2">•</span>
              <span><i class="far fa-clock mr-1"></i> Last updated: 2025-06-01</span>
            </div>
          </div>
        </div>
        <div class="resource-actions opacity-0 transition-opacity flex space-x-2">
          <button class="p-2 text-blue-500 hover:bg-blue-100 rounded-full" title="View Survey">
            <i class="fas fa-eye"></i>
          </button>
          <button class="p-2 text-green-500 hover:bg-green-100 rounded-full" title="Edit Survey">
            <i class="fas fa-edit"></i>
          </button>
          <button class="p-2 text-purple-500 hover:bg-purple-100 rounded-full" title="Responses">
            <i class="fas fa-chart-pie"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-6 text-center">
    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium inline-flex items-center">
      View All Questionnaires <i class="fas fa-arrow-right ml-2"></i>
    </a>
  </div>
</div>

            </div>
            <!-- questionaires -->
                
            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                {{-- <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button class="w-full flex items-center p-3 text-left rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                            <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                <i class="fas fa-plus text-blue-600"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Create New Note</div>
                                <div class="text-sm text-gray-500">Start a new research note</div>
                            </div>
                        </button>
                        <button class="w-full flex items-center p-3 text-left rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                            <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center justify-center mr-3">
                                <i class="fas fa-upload text-green-600"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Upload Resources</div>
                                <div class="text-sm text-gray-500">Add files to your archive</div>
                            </div>
                        </button>
                        <button class="w-full flex items-center p-3 text-left rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                            <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center mr-3">
                                <i class="fas fa-clipboard-list text-purple-600"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">New Questionnaire</div>
                                <div class="text-sm text-gray-500">Create a research survey</div>
                            </div>
                        </button>
                    </div>
                </div> --}}
                
                <!-- Systems Section -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Your Systems</h3>
                        <button class="text-blue-600 hover:text-blue-700">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer">
                            <div class="h-10 w-10 rounded-lg bg-indigo-100 flex items-center justify-center mr-3">
                                <i class="fas fa-database text-indigo-600"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Urban Planning Database</div>
                                <div class="text-sm text-gray-500">42 datasets • Updated today</div>
                            </div>
                        </div>
                        <div class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer">
                            <div class="h-10 w-10 rounded-lg bg-amber-100 flex items-center justify-center mr-3">
                                <i class="fas fa-landmark text-amber-600"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Historical Architecture</div>
                                <div class="text-sm text-gray-500">18 collections • Updated 3 days ago</div>
                            </div>
                        </div>
                        <div class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer">
                            <div class="h-10 w-10 rounded-lg bg-emerald-100 flex items-center justify-center mr-3">
                                <i class="fas fa-leaf text-emerald-600"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Environmental Studies</div>
                                <div class="text-sm text-gray-500">7 datasets • Updated last week</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Activity Feed -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Activity</h3>
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
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
                                <i class="fas fa-share-alt text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-700">You shared <span class="font-medium">Medieval Architecture</span> with 3 colleagues</div>
                                <div class="text-xs text-gray-500 mt-1">Yesterday</div>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-file-import text-purple-600 text-sm"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-700">You imported data to <span class="font-medium">Environmental Studies</span></div>
                                <div class="text-xs text-gray-500 mt-1">2 days ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection