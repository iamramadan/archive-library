@extends('layout.entry')
@section('title','update-institution')
@section('heading','Update Institution')
@push('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
@endpush
@section('main')
    <main class="max-w-3xl mx-auto p-4 mt-8">
        <!-- Logo Upload Form -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Institution Logo</h2>
            <form id="logoUploadForm" action="{{route('create.UpdateLogo')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$institute->id}}"/>
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
        <form class="bg-white rounded-xl shadow-sm p-6" action="{{route('create.system.store')}}"  method="post">
        @csrf
            <div class="space-y-6">
            
                <!-- Name Field -->
                <input type="hidden" name='id' value="{{$institute->id}}">
                <input type="hidden" name='creator' value="{{Auth::user()->id}}">
                <div>
                    <x-error name="name"/>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Institution Name</label>
                    <input type="text"
                           name="name"
                           value='{{$institute->name}}'
                           required 
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                           placeholder="Enter institution name">
                </div>

                <!-- About Field -->
                <div>
                    <x-error name="about"/>
                    <label class="block text-sm font-medium text-gray-700 mb-2">About Institution</label>
                    <textarea rows="4" 
                              name="about"
                              required
                              class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                              placeholder="Describe the institution's purpose and focus">{{$institute->about}}</textarea>
                </div>

                <!-- Form Actions -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex justify-end gap-3">
                        <a href="#" class="px-6 py-2 text-gray-600 hover:text-gray-800">Cancel</a>
                        <input type="submit" 
                        value="Create Institution"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            
                    </div>
                </div>
            </div>
    </form>
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
