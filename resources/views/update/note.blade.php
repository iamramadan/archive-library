@extends('layout.entry')
@section('title',$note->title)
@section('heading',ucwords($note->title))
@push('links')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tiny.cloud/1/hw4k6x5063s8h7ssoe3x3s66iu1ygw5hvhf0agxja3orvzru/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
@endpush
@section('main')
    @if (session('message'))
        <div class="max-w-md mx-auto my-4">
            <div class="flex items-center justify-between bg-blue-100 border border-blue-300 text-blue-700 px-4 py-3 rounded-lg shadow">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M13 16h-1v-4h-1m1-4h.01M12 18.5a6.5 6.5 0 110-13 6.5 6.5 0 010 13z"/>
                    </svg>
                    <span>{{ session('message') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-blue-700 hover:text-blue-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

  <main class="max-w-3xl mx-auto p-4 space-y-6">
            <div class="w-full rounded overflow-hidden shadow-lg bg-white">
                <x-image class="w-full h-48 object-cover" name="{{$note->image}}"/>
                <div class="px-6 py-4">
                    <a href="{{route('pages.note',['id'=>$note->id])}}" class="font-bold text-xl mb-2 text-gray-800">{{$note->title}}</a>
                    <p class="text-gray-600 text-base">
                    {!!Str::limit($note->body,300)!!}....
                    </p>
                </div>
            </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Note</h2>
      <form class="space-y-4" method="post" action="{{route('update.note.store')}}" enctype="multipart/form-data">
      @method("PUT")
        @csrf
        <input type="hidden" value="{{Auth::user()->id}}" name="author"/>
        <input type="hidden" value="{{$note->id}}" name="id"/>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Title*</label>
          <x-error name="title"/>
          <input type="text" name="title" value="{{$note->title}}" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Content*</label>
          <x-error name="body"/>
          <textarea rows="6" name="body" id="body" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">{{$note->body}}</textarea>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Institution</label>
          <x-error name="system"/>
          <select type="text" name="system"  placeholder="Comma-separated tags" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            @foreach($AvailableSystems as $system)
                <option value="{{$system->id}}" @if($system->id == $note->system) selected @endif >{{$system->name}}</option>
            @endforeach
          </select>
        </div>

        <!-- 🔽 Dropify File Upload -->
        <div>
          <x-error name="image"/>
          <label class="block text-sm font-medium text-gray-700 mb-1">Attach File</label>
          <input type="file" name="image"/>
        </div>

        <div class="flex justify-end space-x-3">
          <a href="{{url()->previous()}}" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
          <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
            Update Note
          </button>
        </div>
      </form>
    </div>
  </main>
@endsection
@push('scripts')
<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
      tinymce.init({
        selector: '#body',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      });
      tinymce.init({
        selector: '#body',
        // ... your config
      });
    </script>

@endpush
