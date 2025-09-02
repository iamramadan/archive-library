@extends('layout.main')
@section('title','Manage Questionnaires')
@push('links')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
@endpush
@section('main')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row gap-8">
        <!-- Sidebar -->
        <div class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                <a href="{{route('create.questionaires')}}" class="w-full mb-4 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i> New Questionnaire
                </a>

                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-university text-gray-500 mr-2"></i> Institutions
                </h3>
                <ul class="space-y-1 mb-6">
                    <li>
                        <a href="{{route('pages.manage.questionaires')}}" 
                           class="sidebar-item flex items-center px-3 py-2 rounded-lg {{ request()->has('system') ? '' : 'active bg-blue-50 text-blue-600' }}">
                            <i class="far fa-file-alt mr-2"></i> All Institutions
                            <span class="ml-auto text-gray-500">{{$all}}</span>
                        </a>
                    </li>
                    @foreach ($systems as $system)
                        @php 
                            $isActive = request('system') === $system->name;
                            $countForSystem = isset($systemCounts) 
                                ? ($systemCounts[$system->name] ?? 0) 
                                : ($questionaires->where('system', $system->name)->count());
                        @endphp
                        <li>
                            <a href="{{route('pages.manage.questionaires',['system'=>$system->name])}}" 
                               class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 {{ $isActive ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="fas fa-bookmark mr-2 text-blue-500"></i>{{ucwords($system->name)}}
                                @if($isActive)
                                    <span class="ml-auto text-gray-500">{{$questionaires->count()}}</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>

                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-cog text-gray-500 mr-2"></i> Quick Actions
                </h3>
                <div class="flex flex-col gap-2">
                    <button class="w-full flex items-center p-3 text-gray-700 rounded-lg hover:bg-blue-50 transition-colors">
                        <i class="fas fa-download text-green-500 mr-3"></i>
                        <span>Export Data</span>
                    </button>
                    <a href="#" class="w-full flex items-center p-3 text-gray-700 rounded-lg hover:bg-blue-50 transition-colors">
                        <i class="fas fa-cog text-gray-500 mr-3"></i>
                        <span>Settings</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header with Stats -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        @if (request('system'))
                            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                                <i class="far fa-file-alt text-blue-500 mr-2"></i> {{ ucwords(request('system')) }} Questionnaires
                            </h2>
                            <p class="text-gray-600">Active research questionnaires for this institution</p>
                        @else
                            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                                <i class="far fa-file-alt text-blue-500 mr-2"></i> All Questionnaires
                            </h2>
                            <p class="text-gray-600">Your collection of active research questionnaires</p>
                        @endif
                    </div>
                </div>

                <div class="flex flex-wrap gap-4 mt-6">
                    <div class="flex items-center px-4 py-2 bg-blue-50 rounded-lg">
                        <div class="text-blue-600 mr-2">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div>
                            <div class="text-sm text-blue-600">Total Questionnaires</div>
                            <div class="font-bold text-gray-800">{{$all}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Questionnaires Grid -->
            @if($questionaires->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($questionaires as $q)
                        <div class="bg-white rounded-xl shadow-sm p-6 flex flex-col justify-between">
                            <div>
                                <span class="inline-block px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-full">Active</span>
                                <h4 class="text-xl font-bold text-gray-800 mt-2">{{ $q->name ?? 'Untitled Questionnaire' }}</h4>
                                <p class="text-sm text-gray-500 mt-1 flex items-center">
                                    <i class="fas fa-university text-gray-500 mr-2"></i> {{ ucwords(SystemName($q->system) ?? '-') }}
                                </p>
                                <div class="flex items-center text-sm text-gray-600 mt-3">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <span>Created: {{ optional($q->created_at)->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mt-4">
                                <a href="{{route('pages.questionaire',['id'=>$q->id])}}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">
                                    Open
                                </a>
                                <a href="{{route('delete.confirm',['table'=>'questionaire','id'=>$q->id])}}" 
                                   class="p-2 text-gray-500 hover:text-primary rounded-full hover:bg-gray-100">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm p-8 mb-10 flex items-start">
                    <div class="p-3 rounded-lg bg-gray-100 mr-4">
                        <i class="fas fa-info-circle text-gray-600"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800">No questionnaires found</h4>
                        <p class="text-gray-600">
                            There are no questionnaires{{ request('system') ? ' under ' . ucwords(request('system')) : '' }} yet. 
                            Create your first one to get started.
                        </p>
                        <a href="{{ route('create.questionaires') }}" 
                           class="inline-block mt-3 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">
                            Create Questionnaire
                        </a>
                    </div>
                </div>
            @endif

            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                {{$questionaires->links()}}
            </div>
        </div>
    </div>
@endsection
