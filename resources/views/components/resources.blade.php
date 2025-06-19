<div>
    @props(['name','details','created_at','size','id'])
    <div class="resource-card bg-white border border-gray-200 p-4 rounded-lg hover:shadow-md transition-all">
        <a href="{{route('pages.resources',['id'=>$id])}}">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center mr-4">
                        <i class="fas fa-file-pdf text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900 mb-1">{{$name}}</h3>
                        <p class="text-sm text-gray-600">{{$details}}</p>
                        <div class="flex items-center text-xs text-gray-500 mt-1">
                            <span>PDF • {{$size}} MB</span>
                            <span class="mx-2">•</span>
                            <span><i class="far fa-clock mr-1"></i> Uploaded:{{$created_at}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>