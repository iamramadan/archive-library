@extends('layout.entry')
@section('title','Create-Institution')
@section('heading','Create-Institution')
@section('main')
<main class="max-w-3xl mx-auto p-4 mt-8">
    <form class="bg-white rounded-xl shadow-sm p-6" action="{{route('create.system.store')}}" id="institutionForm" method="post">
        @csrf
            <div class="space-y-6">
                <!-- Name Field -->
                <input type="hidden" name='id' value="newentry">
                <input type="hidden" name='creator' value="{{Auth::user()->id}}">
                <div>
                    <x-error name="name"/>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Institution Name</label>
                    <input type="text"
                           name="name"
                           value='{{old('name')}}'
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
                              placeholder="Describe the institution's purpose and focus">{{old('about')}}</textarea>
                </div>

                <!-- Form Actions -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex justify-end gap-3">
                        <a href="#" class="px-6 py-2 text-gray-600 hover:text-gray-800">Cancel</a>
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            Create Institution
                        </button>
                    </div>
                </div>
            </div>
    </form>
</main>
@endsection
