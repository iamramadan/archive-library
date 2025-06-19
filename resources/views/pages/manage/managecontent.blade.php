@extends('layout.main')
@section('title')
    Manage Content
@endsection
@push('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                        @foreach ($notes as $content)

                        <x-note title="{{$content->title}}" system="{{Ucwords(SystemName($content->system))}}" id="{{$content->id}}" body="{!!$content->body!!}" DateCreated="{{$content->created_at}}"/>
                        @endforeach

                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <div class="text-sm text-gray-500">Showing {{$notes->count()}} of all notes</div>
                        <a href="{{route('pages.manage.notes')}}" class="px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg flex items-center">
                            See All Notes <i class="fas fa-chevron-down ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Resources Section -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-folder text-green-500 mr-2"></i> Recent Resources
                        </h2>
                        <a class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg flex items-center">
                            <i class="fas fa-plus mr-2"></i> Upload Resource
                        </a>
                    </div>

                    <div class="space-y-4">
                        @foreach ($resources as $resource)
                            <x-resources name="{{$resource->name}}" details="{{$resource->details}}" id="{{$resource->id}}" created_at="{{$resource->created_at}}" size="5"/>
                        @endforeach
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
                        <h3 class="text-lg font-semibold text-gray-800">Your Institution</h3>
                        <button class="text-blue-600 hover:text-blue-700">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="space-y-4">
                    @foreach ($systems as $system)

                        <a href="{{route('pages.institution',['name'=>$system->name])}}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer">
                            <div class="h-10 w-10 rounded-lg bg-indigo-100 flex items-center justify-center mr-3 overflow-hidden">
                                <x-image name="{{ $system->logo }}" class="h-full w-full object-contain"/>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $system->name }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($system->about, 35) }}...</div>
                            </div>
                        </a>

                    @endforeach
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
