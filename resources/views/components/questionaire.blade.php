<div>
    @props(['name','goal','updated_at',])
    <div class="resource-card bg-white border border-gray-200 p-4 rounded-lg hover:shadow-md transition-all">
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <div class="h-12 w-12 rounded-lg bg-yellow-100 flex items-center justify-center mr-4">
            <i class="fas fa-clipboard-list text-yellow-600 text-xl"></i>
          </div>
          <div>
            <h3 class="font-medium text-gray-900 mb-1">{{$name}}</h3>
            <p class="text-sm text-gray-600">{{$goal}}</p>
            <div class="flex items-center text-xs text-gray-500 mt-1">
              {{-- <span>Form • 220 responses</span> --}}
              <span class="mx-2">•</span>
              <span><i class="far fa-clock mr-1"></i> Last updated:{{$updated_at}}</span>
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
        </div>
      </div>
    </div>
</div>