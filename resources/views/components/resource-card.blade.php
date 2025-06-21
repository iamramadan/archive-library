<div>
@props(['name','size','details','uploaded_at','author','filetype','system','filename','id'])
                <div class="resource-card bg-white rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-red-600 text-lg">
                                        <i class="fas {{fileTypeIcon($filetype)}}"></i>
                                    </span>
                                    <span class="text-xs text-gray-500"><i class="far fa-clock mr-1"></i> Uploaded: {{$uploaded_at}}</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-3">{{Ucwords($name)}}</h3>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <div class="mr-4">
                                        <i class="far fa-file mr-1"></i> {{$size}} MB
                                    </div>
                                    <div title="institution">
                                        <i class="fas fa-tag mr-1"></i> {{$system}}
                                    </div>
                                </div>
                            </div>
                            <div class="resource-actions opacity-0 transition-opacity flex space-x-1">
                                <a href="{{route('download',['filename'=>$filename])}}" class="p-2 text-blue-500 hover:bg-blue-100 rounded-full">
                                    <i class="fas fa-download"></i>
                                </a>
                                <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-full">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                                <button class="p-2 text-red-500 hover:bg-red-100 rounded-full">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">
                                {{Ucwords($details)}}
                        </p>
                    </div>
                    <div class="bg-gray-50 px-5 py-3 text-xs text-gray-500 flex justify-between items-center">
                        <span>Uploaded by {{Ucwords($author)}}</span>
                        <a href="{{route('pages.resources',['id'=>$id])}}" class="text-blue-600 hover:text-blue-700 font-medium">
                            View Details <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
</div>