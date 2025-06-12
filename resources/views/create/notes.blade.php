@extends('layout.entry')
@section('title','Create Note')
@section('heading','Create Note')
@push('links')
    <script src="https://cdn.tiny.cloud/1/hw4k6x5063s8h7ssoe3x3s66iu1ygw5hvhf0agxja3orvzru/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
@endpush
@section('main')
  <main class="max-w-3xl mx-auto p-4 space-y-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Note</h2>
      <form class="space-y-4" method="post" action="{{route('create.note.store')}}" enctype="multipart/form-data">
        @csrf
        <div>
        <input type="hidden" value="{{Auth::user()->id}}" name="author"/>
          <label class="block text-sm font-medium text-gray-700 mb-1">Title*</label>
          <x-error name="title"/>
          <input type="text" name="title" value="{{old('title')}}" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Content*</label>
          <x-error name="body"/>
          <textarea rows="6" name="body" id="body" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">{{old('body')}}</textarea>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Institution</label>
          <x-error name="system"/>
          <select type="text" name="system"  placeholder="Comma-separated tags" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            @foreach($AvailableSystems as $system)
                <option value="{{$system->id}}">{{$system->name}}</option>
            @endforeach
          </select>
        </div>

        <!-- 🔽 Dropify File Upload -->
        <div>
          <x-error name="image"/>
          <label class="block text-sm font-medium text-gray-700 mb-1">Attach File</label>
                    <input type="file"
                           name="logo"
                          >
          </div>

        <div class="flex justify-end space-x-3">
          <button type="button" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
          @if ($AvailableSystems->count() != 0)
          <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
            Create Note
          </button>
          @else
          <span> No Institution Create Or Registered </span>
<a href="{{ route('create.system') }}"
   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
   Create New Institution
</a>
          @endif
        </div>
      </form>
    </div>
  </main>
@endsection
@push('scripts')
    <!-- Place the first <script> tag in your HTML's <head> -->


<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: '#body',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>
<script>
  tinymce.init({
    selector: '#body',
    // ... your config
  });
</script>
@endpush
