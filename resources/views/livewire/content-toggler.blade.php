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
            @dd($content)
            @switch($contentDisplayed)
                @case('resources')
                @foreach ($content as $item)
                <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="{{fileTypeIcon($item->filetype)}}"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">{{$item->name}}</h3>
                            <p class="text-sm text-gray-600 mt-2">{{$item->details}}</p>
                            <div class="flex items-center mt-4 text-sm text-gray-500">
                                <span>{{ucwords($item->filetype)}}</span>
                                <span class="mx-2">•</span>
                            @php
                            // {{filesize(asset('storage/files/'.$resource->filename))}}
                                $file = storage_path('app/public/files/'.$item->filename);
                                $filesize = (file_exists($file)) ? number_format(filesize($file)/1048576,2) : null;
                            @endphp
                                <span>{{$filesize}} MB</span>
                            </div>
                            <div class="mt-2 text-sm text-gray-400">Last updated: {{}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                    @break
                @case('note')
                @foreach ($content as $item)
                <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            📝
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">{{$item->title}}</h3>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-3">{{clean_html_limit($item->body)}}</p>
                            <div class="mt-4 text-sm text-gray-400">Last edited: {{$item->updated_at}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                    @break
                @case('questionaires')
                @foreach ($content as $item)
                <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            📊
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">{{ucwords($item->name)}}</h3>
                            <p class="text-sm text-gray-600 mt-2">{{$item->goal}}</p>
                            <div class="flex items-center mt-4 text-sm text-gray-500">
                                <span>45 Questions</span>
                                <span class="mx-2">•</span>
                                {{-- <span>120 Responses</span> --}}
                            </div>
                            <div class="mt-2 text-sm text-blue-600">Created_at:{{$item->created_at}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                    @break
                @default
                    <div class="text-gray-500">Select a category to display content.</div>
            @endswitch
                        {{$content->links()}}

            <!-- Note Card -->


            <!-- Questionnaire Card -->

        </div>
    </main>
</div>
