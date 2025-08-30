<div>
<div class="border-b border-gray-300 my-8">
  <div class="max-w-6xl mx-auto px-4">
    <nav class="flex overflow-x-auto flex-nowrap gap-3 md:gap-6 justify-start scrollbar-hide">

      <!-- Notes Tab -->
      <a
        wire:click="show('notes')"
        class="nav-tab flex items-center gap-2 px-4 py-2 rounded-md transition-all duration-200
               text-gray-700 hover:text-blue-600 hover:bg-gray-100 flex-shrink-0
               @if($showing == 'notes') bg-blue-100 text-blue-600 font-medium shadow-sm @endif"
      >
        <span class="inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-blue-500 rounded-full">
          {{ count($notes['data']) }}
        </span>
        <i class="fas fa-sticky-note"></i>
        <span>Notes</span>
      </a>

      <!-- Questionnaires Tab -->
      <a
        wire:click="show('questionaires')"
        class="nav-tab flex items-center gap-2 px-4 py-2 rounded-md transition-all duration-200
               text-gray-700 hover:text-blue-600 hover:bg-gray-100 flex-shrink-0
               @if($showing == 'questionaires') bg-blue-100 text-blue-600 font-medium shadow-sm @endif"
      >
        <span class="inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-blue-500 rounded-full">
          {{ count($questionaires['data']) }}
        </span>
        <i class="fas fa-clipboard-list"></i>
        <span>Questionnaires</span>
      </a>

      <!-- Resources Tab -->
      <a
        wire:click="show('resources')"
        class="nav-tab flex items-center gap-2 px-4 py-2 rounded-md transition-all duration-200
               text-gray-700 hover:text-blue-600 hover:bg-gray-100 flex-shrink-0
               @if($showing == 'resources') bg-blue-100 text-blue-600 font-medium shadow-sm @endif"
      >
        <span class="inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-blue-500 rounded-full">
          {{ count($resources['data']) }}
        </span>
        <i class="fas fa-book"></i>
        <span>Resources</span>
      </a>

    </nav>
  </div>
</div>





    {{-- @dd($questionaires) --}}
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
                                <a href="{{route('pages.note',['id'=>$note['id']])}}" class="result-url">archlib.edu › notes › {{$note['title']}}</span>
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
                                <p class="text-gray-600">You haven’t added any notes yet. Acquire a ticket that grants you access to an note ,or just make one <small>(click on the plus button above)</small>.</p>
                                <a href="#" class="inline-block mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition">
                                    Add Note
                                </a>
                                </div>
                    @endforelse
 @php
    $currentPage = $notes['current_page'];
    $totalPages = $notes['last_page'];
@endphp

@if($notes['total'] > 1)
<nav class="flex justify-center space-x-2 mt-4">
    {{-- Previous button --}}
    <a href="{{ $currentPage > 1 ? $notes['path'].'?page='.($currentPage - 1) : '#' }}"
       class="px-3 py-1 rounded border {{ $currentPage == 1 ? 'text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200' }}">
        Previous
    </a>

    {{-- Page numbers --}}
    @for ($page = 1; $page <= $totalPages; $page++)
        <a href="{{ $notes['path'].'?page='.$page }}"
           class="px-3 py-1 rounded border {{ $currentPage == $page ? 'bg-blue-600 text-white border-blue-600' : 'text-gray-700 hover:bg-gray-200' }}">
            {{ $page }}
        </a>
    @endfor

    {{-- Next button --}}
    <a href="{{ $currentPage < $totalPages ? $notes['path'].'?page='.($currentPage + 1) : '#' }}"
       class="px-3 py-1 rounded border {{ $currentPage == $totalPages ? 'text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200' }}">
        Next
    </a>
</nav>
@endif

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
                        <p class="text-gray-600">There are no questionnaires available right now.Acquire a ticket that grants you access to one, or simply make yours <small>(click on the plus button above)</small>.</p>
                        <a href="#" class="inline-block mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition">
                            Request Questionnaire
                        </a>
                        </div>
                    @endforelse
@php
    $currentPage = $questionaires['current_page'];
    $totalPages = $questionaires['last_page'];
@endphp

@if($questionaires['total'] > 1)
<nav class="flex justify-center space-x-2 mt-4">
    <a href="{{ $currentPage > 1 ? $questionaires['path'].'?page='.($currentPage - 1) : '#' }}"
       class="px-3 py-1 rounded border {{ $currentPage == 1 ? 'text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200' }}">
        Previous
    </a>

    @for ($page = 1; $page <= $totalPages; $page++)
        <a href="{{ $questionaires['path'].'?page='.$page }}"
           class="px-3 py-1 rounded border {{ $currentPage == $page ? 'bg-blue-600 text-white border-blue-600' : 'text-gray-700 hover:bg-gray-200' }}">
            {{ $page }}
        </a>
    @endfor

    <a href="{{ $currentPage < $totalPages ? $questionaires['path'].'?page='.($currentPage + 1) : '#' }}"
       class="px-3 py-1 rounded border {{ $currentPage == $totalPages ? 'text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200' }}">
        Next
    </a>
</nav>
@endif


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
                            <p class="text-gray-600">You dont have access to resources. Acquire a ticket to get access, or simply make yours <small>(click on the plus button above)</small>.</p>

                            <!-- Call to action button -->
                            <a href="#" class="inline-block mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition">
                                Submit Ticket
                            </a>
                        </div>
                    @endforelse
@php
    $currentPage = $resources['current_page'];
    $totalPages = $resources['last_page'];
@endphp

@if($resources['total'] > 1)
<nav class="flex justify-center space-x-2 mt-4">
    <a href="{{ $currentPage > 1 ? $resources['path'].'?page='.($currentPage - 1) : '#' }}"
       class="px-3 py-1 rounded border {{ $currentPage == 1 ? 'text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200' }}">
        Previous
    </a>

    @for ($page = 1; $page <= $totalPages; $page++)
        <a href="{{ $resources['path'].'?page='.$page }}"
           class="px-3 py-1 rounded border {{ $currentPage == $page ? 'bg-blue-600 text-white border-blue-600' : 'text-gray-700 hover:bg-gray-200' }}">
            {{ $page }}
        </a>
    @endfor

    <a href="{{ $currentPage < $totalPages ? $resources['path'].'?page='.($currentPage + 1) : '#' }}"
       class="px-3 py-1 rounded border {{ $currentPage == $totalPages ? 'text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200' }}">
        Next
    </a>
</nav>
@endif
                    @break
                @default

            @endswitch
        </div>

        <!-- Pagination -->
    </main>
</div>
