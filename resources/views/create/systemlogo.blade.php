@extends('layout.entry')
@section('title','Add-Institution-Logo')
@section('heading','Create-Institution')
@push('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
@endpush
@section('main')
    <main class="max-w-3xl mx-auto p-4 mt-8">
        <!-- Logo Upload Form -->
        <div class="bg-white shadow-md rounded-xl p-6 w-full mb-6">
  <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{$system->name}}</h2>
  <p class="text-gray-600">
    {{$system->about}}
  </p>
</div>


        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Institution Logo</h2>
            <form id="logoUploadForm" action='{{route('create.UpdateLogo')}}' enctype="multipart/form-data" method="post">
            @csrf
            <input type='hidden' name="id" value="{{$systemId}}">
                <div class="space-y-4">
                <x-error name="logo"/>
                    <input type="file" 
                           name="logo"
                           id="logoUpload"
                           class="dropify"
                           data-height="200"
                           data-allowed-file-extensions="png jpg jpeg"
                           data-max-file-size="2M"
                           data-show-remove="false"
                           data-default-file=""
                           data-errors-position="outside"
                           required>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                            onclick="uploadLogo()">
                        Upload Logo
                    </button>
                </div>
            </form>
        </div>

        <!-- Institution Details Form -->
    </main>
@endsection
@push('scripts')
    <script>
        // Initialize Dropify
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop logo or click to browse',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happened.'
                },
                error: {
                    'fileSize': 'File size is too big (2M max).',
                    'fileExtension': 'Allowed extensions: png, jpg, jpeg.'
                }
            });
        });

        // Logo Upload Handler
        function uploadLogo() {
            const fileInput = document.getElementById('logoUpload');
            const file = fileInput.files[0];
            
            if (!file) {
                alert('Please select a logo file');
                return;
            }

            // Add your upload logic here
            const formData = new FormData();
            formData.append('logo', file);

            // Example AJAX call
            /*
            fetch('/upload-logo', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Logo uploaded:', data);
            });
            */
        }

        // Institution Form Handler
        document.getElementById('institutionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add form submission logic here
            console.log('Submitting institution details');
        });
    </script>
@endpush