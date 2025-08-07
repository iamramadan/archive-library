<div>
    <div class="border-b border-gray-300 my-8">
  <div class="max-w-6xl mx-auto px-4">
    <nav class="flex flex-wrap gap-4 md:gap-8 justify-center md:justify-start">
      {{-- <a
        wire:click="show('all')"
        class="nav-tab flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition @if($showing == 'all') active @endif bg-blue-100 text-blue-600"
      >
        <i class="fas fa-globe mr-2"></i> All
      </a> --}}
    <a
        wire:click="show('notes')"
        class="@if($showing == 'notes') active @endif nav-tab flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition"
      >
        <i class="fas fa-sticky-note mr-2"></i> Notes
      </a>
      <a
        wire:click="show('questionaires')"
        class=" @if($showing == 'questionaires') active @endif nav-tab flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition"
      >
        <i class="fas fa-clipboard-list mr-2"></i> Questionnaires
      </a>

      <a
        wire:click="show('resources')"
        class="@if($showing == 'resources') active @endif nav-tab flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition"
      >
        <i class="fas fa-book mr-2"></i> Resources
      </a>
    </nav>
  </div>
</div>

    {{-- @dd($all)
    @dd($resources)
    @dd($notes) --}}
    <!-- Main Content -->
    <main class="flex-grow max-w-3xl mx-auto px-4 py-6 w-full">
        <h1 class="text-dark">{{ucwords($showing)}}</h1>
        <p class="text-gray-600 text-sm mb-6">Showing Results For "{{$query}}"</p>
     
        <!-- Search Results -->
        <div class="space-y-8">
            <!-- Result 1 -->
            {{-- @dd($notes) --}}
            @switch($showing)
                @case('notes')
                {{-- @dd($notes) --}}
                    @forelse ($notes['data'] as $note)
                        <div  class="result-card p-4 rounded-lg">
                            <div class="flex items-center mb-1">
                                <a href="{{route('pages.note',['id'=>$note['id']])}}" class="result-url">archlib.edu › notes › {{$note['name']}}</span>
                            </div>
                            <a href="#" class="result-title text-xl font-medium mb-1 inline-block">{!!highlightWord($note['title'],$query)!!}</a>
                            <p class="text-gray-700 mb-2">{!!highlightWord(Str::limit($note['body'],50),$query)!!}</p>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="tag"><i class="fas fa-sticky-note mr-1"></i>Notes</span>
                                <span class="tag"><i class="fas fa-eye mr-1"></i>Published on: {{Carbon\Carbon::parse($note['created_at'])->format('d M Y')}}</span>
                            </div>
                        </div>
                    @empty
                                <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md flex flex-col items-center text-center space-y-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-24 w-24 text-gray-400">
                                    <g fill="none" fill-rule="evenodd">
                                    <circle cx="32" cy="32" r="30" fill="#F2F2F2"/>
                                    <circle cx="21" cy="24" r="6" fill="#444"/>
                                    <circle cx="43" cy="24" r="6" fill="#444"/>
                                    <circle cx="23" cy="24" r="2" fill="#fff"/>
                                    <circle cx="41" cy="24" r="2" fill="#fff"/>
                                    <path d="M24 40c2 2 5 3 8 3s6-1 8-3" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="32" cy="32" r="30" stroke="#ddd" stroke-width="2"/>
                                    </g>
                                </svg>
                                <h2 class="text-xl font-semibold text-gray-800">No Notes Found</h2>
                                <p class="text-gray-600">You haven’t added any notes yet. Start jotting something down to save it here.</p>
                                <a href="#" class="inline-block mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition">
                                    Add Note
                                </a>
                                </div>
                    @endforelse
                    @break
                @case('questionaires')
                    @forelse ($questionaires['data'] as $questionaire)
                        <div class="result-card p-4 rounded-lg">
                            <div class="flex items-center mb-1">
                                {{-- <span class="result-url">https://archlib.edu › questionnaires › RM-2024</span> --}}
                            </div>
                            <a href="{{route('pages.questionaire',['id'=>$questionaire['id']])}}" class="result-title text-xl font-medium mb-1 inline-block">{!!highlightWord($questionaire['name'],$query)!!}</a>
                            <p class="text-gray-700 mb-2">{!!highlightWord($questionaire['goal'],$query)!!}</p>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="tag"><i class="fas fa-clipboard-list mr-1"></i>Questionnaire</span>
                                <span class="tag"><i class="fas fa-users mr-1"></i>Used by most researchers</span>
                                <span class="tag"><i class="fas fa-users mr-1"></i>Drafted on {{Carbon\Carbon::parse($questionaire['created_at'])->format('d M Y')}}</span>
                            </div>
                        </div>
                    @empty
                        <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md flex flex-col items-center text-center space-y-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-24 w-24 text-gray-400">
                            <g fill="none" fill-rule="evenodd">
                            <circle cx="32" cy="32" r="30" fill="#F2F2F2"/>
                            <circle cx="21" cy="24" r="6" fill="#444"/>
                            <circle cx="43" cy="24" r="6" fill="#444"/>
                            <circle cx="23" cy="24" r="2" fill="#fff"/>
                            <circle cx="41" cy="24" r="2" fill="#fff"/>
                            <path d="M24 40c2 2 5 3 8 3s6-1 8-3" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="32" cy="32" r="30" stroke="#ddd" stroke-width="2"/>
                            </g>
                        </svg>
                        <h2 class="text-xl font-semibold text-gray-800">No Questionnaires Yet</h2>
                        <p class="text-gray-600">There are no questionnaires available right now. Please check back later or request one.</p>
                        <a href="#" class="inline-block mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition">
                            Request Questionnaire
                        </a>
                        </div>
                    @endforelse
                    @break
                @case('resources')
                    @forelse ($resources['data'] as $resource)
                        <div class="result-card p-4 rounded-lg">
                            <div class="flex items-center mb-1">
                                <a href="{{route('pages.resources',['id'=>$resource['id']])}}" class="result-url">archlib.edu › notes › {{$resource['name']}}</a>
                            </div>
                            <a href="{{route('pages.resources',['id'=>$resource['id']])}}" class="result-title text-xl font-medium mb-1 inline-block">{!!highlightWord($resource['name'],$query)!!}</a>
                            <p class="text-gray-700 mb-2">{!!highlightWord($resource['details'],$query)!!}</p>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="tag"><i class="fas fa-book mr-1"></i>Resource</span>
                                <span class="tag"><i class="fas fa-calendar mr-1"></i>Published on {{Carbon\Carbon::parse($resource['created_at'])->format('d M Y')}}</span>
                            </div>
                        </div>
                    @empty
                        <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md flex flex-col items-center text-center space-y-4">
                            <!-- Sad Panda SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-24 w-24 text-gray-400">
                                <g fill="none" fill-rule="evenodd">
                                    <circle cx="32" cy="32" r="30" fill="#F2F2F2"/>
                                    <circle cx="21" cy="24" r="6" fill="#444"/>
                                    <circle cx="43" cy="24" r="6" fill="#444"/>
                                    <circle cx="23" cy="24" r="2" fill="#fff"/>
                                    <circle cx="41" cy="24" r="2" fill="#fff"/>
                                    <path d="M24 40c2 2 5 3 8 3s6-1 8-3" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="32" cy="32" r="30" stroke="#ddd" stroke-width="2"/>
                                </g>
                            </svg>

                            <!-- Updated Message -->
                            <h2 class="text-xl font-semibold text-gray-800">Oops! No Resources</h2>
                            <p class="text-gray-600">You dont have access to resources. Submit a ticket to request more.</p>

                            <!-- Call to action button -->
                            <a href="#" class="inline-block mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition">
                                Submit Ticket
                            </a>
                        </div>
                    @endforelse
                    @break
                @default

            @endswitch
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <div class="flex items-center space-x-1">
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center text-blue-600">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium text-white bg-primary rounded-full">1</a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium">2</a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium">3</a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium">4</a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium">5</a>
                <span class="px-2">...</span>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium">10</a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center text-blue-600">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </main>
</div>
