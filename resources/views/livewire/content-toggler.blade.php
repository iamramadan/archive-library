<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex space-x-8 border-b">
            <div  wire:click='sort("resources")'  class="py-3 px-1 @if($contentDisplayed == 'resources') border-b-2 border-blue-500 text-blue-600 @else text-gray-500 hover:text-blue-600 @endif ">Resources</div>
            <div  wire:click='sort("note")' class="py-3 px-1 @if($contentDisplayed == 'note') border-b-2 border-blue-500 @else text-gray-500 hover:text-blue-600 @endif ">Notes</div>
            <div  wire:click='sort("questionaires")' class="py-3 px-1 @if($contentDisplayed == 'questionaires') border-b-2 border-blue-500 @else text-gray-500 hover:text-blue-600 @endif ">Questionnaires</div>
        </div>

    </div>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Resource Card -->
             
            @switch($contentDisplayed)
                @case('resources')
                @forelse ($content['data'] as $item)
                <a href="{{ route('pages.resources',['id'=>$item['id']]) }}" class="block">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 transition-all transform hover:-translate-y-1 hover:scale-105 hover:shadow-lg duration-200 cursor-pointer hover:bg-gray-50">
        <!-- Title -->
        <h3 class="text-lg font-semibold text-gray-900">{{ $item['name'] }}</h3>

        <!-- Description -->
        <p class="text-gray-600 mt-2 line-clamp-3">{{ $item['details'] }}</p>

        <!-- Metadata badges -->
        <div class="flex flex-wrap items-center mt-4 gap-2">
            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">{{ ucwords($item['filetype']) }}</span>

            @php
                $file = storage_path('app/public/files/'.$item['filename']);
                $filesize = (file_exists($file)) ? number_format(filesize($file)/1048576,2) : null;
            @endphp
            @if($filesize)
                <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-full">{{ $filesize }} MB</span>
            @endif
        </div>

        <!-- Last updated -->
        <div class="mt-3 text-sm text-gray-400">Last updated: {{ \Carbon\Carbon::parse($item['updated_at'])->format('M d, Y') }}</div>
    </div>
</a>

		@empty
		<div class="flex justify-center items-center h-64">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 flex flex-col items-center text-center space-y-4">
        <!-- Puppy SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2c-1.1 0-2 .9-2 2v1H9c-1.1 0-2 .9-2 2v2H5c-1.1 0-2 .9-2 2v1h2v6h2v-6h2v6h2v-6h2v6h2v-6h2v-1c0-1.1-.9-2-2-2h-2V7c0-1.1-.9-2-2-2h-1V4c0-1.1-.9-2-2-2z"/>
        </svg>

        <!-- Message -->
        <h3 class="text-xl font-semibold text-gray-800">No resources available</h3>
        <p class="text-gray-500 text-sm">Looks like there’s nothing here yet. Try adding some resources!</p>
    </div>
</div>

                @endforelse
                    @break
                @case('note')
                @forelse ($content['data'] as $item)
<a href="{{ route('pages.note',['id'=>$item['id']]) }}" class="block">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 transition-all transform hover:-translate-y-1 hover:scale-105 hover:shadow-lg duration-200 cursor-pointer hover:bg-gray-50">
        <!-- Title -->
        <h3 class="text-lg font-semibold text-gray-900">{{ $item['title'] }}</h3>

        <!-- Body / Note content -->
        <p class="text-gray-600 mt-2 line-clamp-3">{!! clean_html_limit($item['body'],100) !!}</p>

        <!-- Metadata -->
        <div class="mt-3 text-sm text-gray-400">Last edited: {{ \Carbon\Carbon::parse($item['updated_at'])->format('M d, Y') }}</div>
    </div>
</a>

		@empty
		<div class="flex justify-center items-center h-64">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 flex flex-col items-center text-center space-y-4">
        <!-- Notes SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-green-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 2H5c-1.1 0-2 .9-2 2v16l4-4h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM5 18v-2.17L6.17 16H19v2H5z"/>
        </svg>

        <!-- Message -->
        <h3 class="text-xl font-semibold text-gray-800">No notes available</h3>
        <p class="text-gray-500 text-sm">You haven’t created any notes yet. Start by adding one!</p>
    </div>
</div>

                @endforelse
                    @break
                @case('questionaires')
                @forelse ($content['data'] as $item)
<a href="{{ route('pages.questionaire',['id'=>$item['id']]) }}" class="block">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 transition-all transform hover:-translate-y-1 hover:scale-105 hover:shadow-lg duration-200 cursor-pointer hover:bg-gray-50">
        <!-- Title -->
        <h3 class="text-xl font-bold text-gray-900">{{ ucwords($item['name']) }}</h3>

        <!-- Description / Goal -->
        <p class="text-gray-600 mt-2 line-clamp-3 italic">{{ $item['goal'] }}</p>

        <!-- Metadata badges -->
        <div class="flex flex-wrap items-center mt-4 gap-2">
            <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">45 Questions</span>
            {{-- <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">120 Responses</span> --}}
            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">Created: {{ \Carbon\Carbon::parse($item['created_at'])->format('M d, Y') }}</span>
        </div>
    </div>
</a>



		@empty
		<div class="flex justify-center items-center h-64">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 flex flex-col items-center text-center space-y-4">
        <!-- Questionnaire SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-purple-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 4h18v2H3V4zm0 4h18v2H3V8zm0 4h12v2H3v-2zm0 4h12v2H3v-2zm0 4h12v2H3v-2z"/>
        </svg>

        <!-- Message -->
        <h3 class="text-xl font-semibold text-gray-800">No questionnaires available</h3>
        <p class="text-gray-500 text-sm">You haven’t created any questionnaires yet. Start by adding one!</p>
    </div>
</div>

                @endforelse
                    @break
                @default
                    <div class="text-gray-500">Select a category to display content.</div>
            @endswitch
                        

            <!-- Note Card -->



            <!-- Questionnaire Card -->

        </div>
<div class="flex justify-center mt-6 space-x-2">
    {{-- Previous arrow --}}
    @if($content['prev_page_url'])
        <a href="{{ $content['prev_page_url'] }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 flex items-center">
            &laquo; Previous
        </a>
    @else
        <span class="px-3 py-1 rounded bg-gray-100 text-gray-400 flex items-center cursor-not-allowed">
            &laquo; Previous
        </span>
    @endif

    {{-- Page links --}}
    @foreach($content['links'] as $link)
        @if($link['active'])
            <span class="px-3 py-1 rounded bg-blue-500 text-white">{!! $link['label'] !!}</span>
        @elseif($link['url'])
            <a href="{{ $link['url'] }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">{!! $link['label'] !!}</a>
        @endif
    @endforeach

    {{-- Next arrow --}}
    @if($content['next_page_url'])
        <a href="{{ $content['next_page_url'] }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 flex items-center">
            Next &raquo;
        </a>
    @else
        <span class="px-3 py-1 rounded bg-gray-100 text-gray-400 flex items-center cursor-not-allowed">
            Next &raquo;
        </span>
    @endif
</div>

    </main>
</div>
