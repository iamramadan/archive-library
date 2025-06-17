<div>
@props(['system','updated_at','title','body','id','created_at'])
    <div class="note-card bg-white rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="tag-research px-3 py-1 text-xs font-medium rounded-full">{{$system}}</span>
                                    <span class="text-xs text-gray-500"><i class="far fa-clock mr-1"></i> Updated:{{$updated_at}}</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-3">{{$title}}</h3>
                                <p class="note-content text-gray-600 text-sm mb-4">
                                        {!!Str::limit($body,150)!!} ...
                                </p>
                            </div>
                            <div class="note-actions  transition-opacity flex space-x-1">
                                <a  href="{{route('update.note',['id'=>$id])}}" class="p-2 text-blue-500 hover:bg-blue-100 rounded-full">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{route('delete.confirm',['table'=>'note','id'=>$id])}}" class="p-2 text-red-500 hover:bg-red-100 rounded-full">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                <i class="far fa-file-alt mr-1"></i> {{str_word_count($body)}} {{Str::plural('word',str_word_count($body))}}
                            </div>
                            <div>
                                <i class="far fa-bookmark mr-1"></i>{{$system}}
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3 text-xs text-gray-500 flex justify-between items-center">
                        <span>Created: {{$created_at}}</span>
                        <a href="{{route('pages.note',['id'=>$id])}}" class="text-blue-600 hover:text-blue-700 font-medium">
                            View Details <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
</div>