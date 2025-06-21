@extends('layout.entry')

@section('title','Create Resources')
@section('heading','Create Resources')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css" integrity="sha512-RAK+cP4RZqz2iW8ojkMLke3CllCBNzCzGJ3q4dV36C+t5YtYZo4BGPHnVqOH/d2QQkWc8rP0P8bpeY48alGxwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js" integrity="sha512-KY1W0cREb9SgBeDR+x1U8P4I3R0NhRwLaSxEqw0cgtdR6v4F6s5WyhtMXNk9oTn41RtiymzQg9zK+VCEy5cW5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.dropify').dropify();
    });
</script>
@endpush

@section('main')
<main class="max-w-3xl mx-auto p-4">
    <div class="bg-white rounded-lg shadow-sm p-6">
    @if (session('message'))
          <div class="mt-1 text-sm text-red-600">
              {{session('message')}}
          </div>
      @endif
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Upload New Resource</h2>
        <form class="space-y-4" method="post" enctype="multipart/form-data" action="{{ route('create.resources.UpdateStore') }}">
            @csrf 
            <input type="hidden" value="{{Auth::user()->id}}" name="author">
            <div>
                <x-error name="name"/>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name*</label>
                <input type="text" name="name" value="{{old('name')}}" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <x-error name="details"/>
                <label class="block text-sm font-medium text-gray-700 mb-1">Details*</label>
                <div><small>add more info about this resources</small></div>
                <textarea name="details" value="{{old('details')}}" rows="3" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"></textarea>
            </div>
            @if($AvailableSystems->count())
             <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Institution</label>
                <x-error name="system"/>
                <select type="text" name="system"  placeholder="Comma-separated tags" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    @foreach($AvailableSystems as $system)
                        <option value="{{$system->id}}">{{$system->name}}</option>
                    @endforeach
                </select>
              </div>
            @else
            <div class="md:col-span-2 text-center py-12 text-gray-500" id="emptyState">
                <p class="mb-4">No institutions found</p>
                <a href="{{route('create.system')}}"
                   class="px-4 py-2 text-blue-600 hover:text-blue-700 border border-blue-600 rounded-full">
                    Create Your First Institution
                </a>
            </div>
            @endif
            <div>
                <x-error name="filename"/>
                <label class="block text-sm font-medium text-gray-700 mb-1">File Upload*</label>
                <input type="file" name="filename" value="{{old('filename')}}" required class="dropify" data-max-file-size="50M" data-allowed-file-extensions="pdf docx csv" />
            </div>
            <div class="flex justify-end space-x-3">
                <a href="{{route('index')}}"  class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</a>
                @if ($AvailableSystems->count())           
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Upload Resource
                </button>
                @endif
            </div>
        </form>
    </div>
</main>
@endsection
