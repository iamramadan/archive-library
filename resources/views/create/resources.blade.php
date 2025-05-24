@extends('layout.entry')
@section('title','Create Resources')
@section('heading','Create Resources')
@section('main')
        <main class="max-w-3xl mx-auto p-4">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Upload New Resource</h2>
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title*</label>
                    <input type="text" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description*</label>
                    <textarea rows="3" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">File Upload*</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-lg p-8 text-center hover:border-blue-300 transition-colors">
                        <input type="file" class="hidden" id="fileInput">
                        <label for="fileInput" class="cursor-pointer text-blue-600 hover:text-blue-700">
                            Click to upload file
                        </label>
                        <p class="text-sm text-gray-500 mt-2">PDF, DOCX, CSV (Max 50MB)</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        Upload Resource
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection