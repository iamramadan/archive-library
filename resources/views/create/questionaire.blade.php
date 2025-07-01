@extends('layout.entry')
@section('title','Create Questionaires')
@section('heading','Create Questionaires')
@push('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
        }

        .card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(79, 114, 205, 0.15);
        }

        .system-card.selected {
            border-color: #4f46e5;
            background-color: #f0f4ff;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.1);
        }

        .next-btn {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
        }

        .next-btn:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.4);
        }

        .step-indicator {
            position: relative;
        }

        .step-indicator::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -40px;
            width: 30px;
            height: 2px;
            background: #cbd5e1;
            transform: translateY(-50%);
        }

        .step-indicator:last-child::after {
            display: none;
        }

        .step-indicator.active {
            color: #4f46e5;
            font-weight: 600;
        }

        .step-indicator.active .step-number {
            background: #4f46e5;
            color: white;
        }
    </style>
@endpush
@section('main')
    <main class="max-w-4xl mx-auto px-4 py-8">
        <!-- Progress Steps -->
        {{-- <div class="flex justify-center mb-10">
            <div class="flex space-x-16">
                <div class="step-indicator active">
                    <div class="step-number w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center mb-2">
                        1
                    </div>
                    <span>Basic Info</span>
                </div>
                <div class="step-indicator">
                    <div class="step-number w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center mb-2">
                        2
                    </div>
                    <span>Add Questions</span>
                </div>
                <div class="step-indicator">
                    <div class="step-number w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center mb-2">
                        3
                    </div>
                    <span>Review</span>
                </div>
            </div>
        </div> --}}

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-6 bg-gradient-to-r from-indigo-600 to-purple-600">
                <h2 class="text-2xl font-bold text-white">Create New Questionnaire</h2>
                <p class="text-indigo-100">Fill in the basic details for your new questionnaire</p>
            </div>

            <div class="p-6 md:p-8">
                <form class="space-y-8" action='{{route('create.questionaires.store')}}' method="POST">
                    @method('POST')
                    @csrf
                    <!-- Title Field -->
                    <input name="author" value="{{Auth::user()->id}}" type="hidden"/>
                    <div class="space-y-2">
                        <x-error name="name"/>
                        <label class="block text-lg font-medium text-gray-800">Questionnaire Title*</label>
                        <p class="text-gray-600 text-sm">Give your questionnaire a clear and descriptive title</p>
                        <input type="text"
                        name='name'
                        value="{{old('name')}}"
                        required
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                    </div>

                    <!-- Goals Field -->
                    <div class="space-y-2">
                        <x-error name="goal"/>
                        <label class="block text-lg font-medium text-gray-800">Goals & Objectives*</label>
                        <p class="text-gray-600 text-sm">Describe what you aim to achieve with this questionnaire</p>
                        <textarea rows="4" required
                        name='goal'
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">{{old('goal')}}</textarea>
                    </div>

                    <!-- Systems Section -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-lg font-medium text-gray-800">Select Systems*</label>
                            <p class="text-gray-600 text-sm">Choose which systems this questionnaire applies to</p>
                        </div>

                        @if($systems->count())
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Institution</label>
                            <x-error name="system"/>
                            <select type="text" name="system"  placeholder="Comma-separated tags" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                @foreach($systems as $system)
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
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col-reverse md:flex-row md:items-center md:justify-between pt-6 border-t border-gray-200">
                        <a href="{{route('index')}}" class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium rounded-lg transition-colors">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" class="next-btn mb-4 md:mb-0 px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-semibold text-lg">
                            Next <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tips Section -->
        
    </main>
@endsection
