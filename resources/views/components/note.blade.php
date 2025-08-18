<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    @props(['id','title','body','DateCreated','system'])

     <div class="note-card bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 p-4 rounded-lg hover:shadow-md transition-all cursor-pointer">
                        <a href="{{route('pages.note',['id'=>$id])}}">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center mb-1">
                                        <h3 class="font-semibold text-gray-900 mr-2">{{ucwords($title)}}</h3>
                                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">{{$system}}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{!!clean_html_limit($body,300)!!}  .....</p>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span><i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($DateCreated)->format('d M Y') }}</span>
                                        <span class="mx-2">•</span>
                                        <span><i class="far fa-file-alt mr-1"></i> {{str_word_count($body)}} words</span>
                                    </div>
                                </div>
                                <div class="note-actions opacity-0 transition-opacity flex space-x-1">
                                    <a href="{{route('update.note',['id'=>$id])}}" class="p-2 text-blue-500 hover:bg-blue-100 rounded-full">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('delete.confirm',['table'=>'note','id'=>$id])}}" class="p-2 text-red-500 hover:bg-red-100 rounded-full">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </a>
    </div>
</div>
