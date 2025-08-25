@extends('layout.main')
@push('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#0ea5e9',
                        dark: '#1e293b',
                        light: '#f8fafc',
                        success: '#10b981',
                        warning: '#f59e0b',
                        danger: '#ef4444',
                        academic: '#1e40af'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .dashboard-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .content-container {
            display: flex;
            flex: 1;
        }
        
        .sidebar {
            width: 30%;
            background: white;
            border-right: 1px solid #e5e7eb;
            padding: 1.5rem;
            overflow-y: auto;
        }
        
        .main-content {
            width: 70%;
            padding: 1.5rem;
            background-color: #f8fafc;
            overflow-y: auto;
        }
        
        .dashboard-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border-radius: 10px;
            background: white;
            overflow: hidden;
        }
        
        .institution-card {
            transition: all 0.2s ease;
            cursor: pointer;
            border-left: 4px solid transparent;
        }
        
        .institution-card.active {
            border-left-color: #2563eb;
            background-color: #eff6ff;
        }
        
        .progress-bar {
            height: 8px;
            border-radius: 4px;
        }
        
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
        }
        
        .questionnaire-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .academic-header {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
        }
        
        .institution-logo {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 16px;
            color: white;
        }
        
        @media (max-width: 1024px) {
            .content-container {
                flex-direction: column;
            }
            
            .sidebar, .main-content {
                width: 100%;
            }
            
            .sidebar {
                border-right: none;
                border-bottom: 1px solid #e5e7eb;
            }
        }
        
        .chart-container {
            height: 250px;
        }
    </style>
@endpush
@section('main')
    <div class="content-container">
        <!-- Sidebar (30% width) -->
        <div class="sidebar">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Institutions</h3>
            
            <div class="space-y-3">
                <div class="institution-card {{ request()->has('system') ? '' : 'active' }} p-3 rounded-lg" data-institution="all">
                    <a href="{{ route('pages.manage.questionaires') }}" aria-current="{{ request()->has('system') ? 'false' : 'true' }}">
                        <div class="flex items-center">
                            <div class="institution-logo bg-blue-500">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-semibold text-gray-800">All Institutions</h4>
                                <p class="text-xs text-gray-500">Showing all questionnaires</p>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $all }}</span>
                        </div>
                    </a>
                </div>

                @foreach ($systems as $system)
                    @php
                        $isActive = request('system') === $system->name;
                        $slug = \Illuminate\Support\Str::slug($system->name);
                        $countForSystem = isset($systemCounts) ? ($systemCounts[$system->name] ?? 0) : ($questionaires->where('system', $system->name)->count());
                    @endphp
                    <div class="institution-card {{ $isActive ? 'active' : '' }} p-3 rounded-lg" data-institution="{{ $slug }}">
                        <a href="{{ route('pages.manage.questionaires', ['system' => $system->name]) }}" aria-current="{{ $isActive ? 'true' : 'false' }}">
                            <div class="flex items-center">
                                <div class="institution-logo bg-red-500">
                                    <i class="fas fa-h"></i>
                                </div>
                                <div class="flex-grow">
                                    <h4 class="font-semibold text-gray-800">{{ ucwords($system->name) }}</h4>
                                    @if ($isActive)
                                        <p class="text-xs text-gray-500">{{$questionaires->count()}} active questionnaires</p>
                                    @endif
                                </div>
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">{{$questionaires->count()}}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('create.questionaires') }}" class="w-full flex items-center p-3 text-gray-700 rounded-lg hover:bg-blue-50 transition-colors">
                        <i class="fas fa-plus-circle text-blue-500 mr-3"></i>
                        <span>Create New Questionnaire</span>
                    </a>
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
        
        <!-- Main Content (70% width) -->
        <div class="main-content">
            <div class="max-w-6xl mx-auto">
                <!-- Dashboard Header -->
                <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800" id="institution-title">
                            {{ request('system') ? ucwords(request('system')) : 'All Institutions' }}
                        </h2>
                        <p class="text-gray-600">Active research questionnaires</p>
                    </div>
                </div>
                
                <!-- Stats Cards (sample static numbers; hook up to real stats as needed) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="dashboard-card p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg mr-4">
                                <i class="fas fa-clipboard-list text-primary text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $all }}</h3>
                                <p class="text-gray-600">Total Questionnaires</p>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="dashboard-card p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-red-100 rounded-lg mr-4">
                                <i class="fas fa-exclamation-circle text-danger text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">—</h3>
                                <p class="text-gray-600">All Completed</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Questionnaire Grid (dynamic from $questionaires) -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Active Questionnaires</h3>
                    <div class="flex items-center text-sm">
                        <span class="text-gray-500 mr-3">Sort by:</span>
                        <select class="border border-gray-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-primary">
                            <option>Due Date</option>
                            <option>Status</option>
                            <option>Progress</option>
                            <option>Institution</option>
                        </select>
                    </div>
                </div>

                @if($questionaires->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8" id="questionnaire-container">
                        @foreach($questionaires as $q)
                            <div class="dashboard-card questionnaire-item questionnaire-card" data-institution="{{ \Illuminate\Support\Str::slug($q->system ?? 'general') }}">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <span class="status-badge bg-blue-100 text-blue-800">Active</span>
                                            <h4 class="text-xl font-bold text-gray-800 mt-2">{{ $q->name ?? 'Untitled Questionnaire' }}</h4>
                                            <p class="text-sm text-gray-500 mt-1 flex items-center">
                                                <i class="fas fa-university text-gray-500 mr-2"></i> {{ ucwords(SystemName($q->system) ?? '-') }}
                                            </p>
                                        </div>
                                        <div class="bg-gray-100 w-12 h-12 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-clipboard-list text-gray-700 text-xl"></i>
                                        </div>
                                    </div>

                                    <div class="flex items-center text-sm text-gray-600 mb-4">
                                        <i class="far fa-calendar-alt mr-2"></i>
                                        <span>Created: {{ optional($q->created_at)->format('M d, Y') }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <a href="{{route('pages.questionaire',['id'=>$q->id])}}" class="px-4 py-2 bg-primary hover:bg-blue-700 text-white rounded-lg text-sm">
                                            Open
                                        </a>
                                        <a href="{{route('delete.confirm',['table'=>'questionaire','id'=>$q->id])}}" class="p-2 text-gray-500 hover:text-primary rounded-full hover:bg-gray-100">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="dashboard-card p-8 mb-10">
                        <div class="flex items-start">
                            <div class="p-3 rounded-lg bg-gray-100 mr-4">
                                <i class="fas fa-info-circle text-gray-600"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">No questionnaires found</h4>
                                <p class="text-gray-600">There are no questionnaires{{ request('system') ? ' under ' . ucwords(request('system')) : '' }} yet. Create your first one to get started.</p>
                                <a href="{{ route('create.questionaires') }}" class="inline-block mt-3 px-4 py-2 bg-primary hover:bg-blue-700 text-white rounded-lg text-sm">Create Questionnaire</a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Charts Section (kept as illustrative UI) -->
                
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- Optional client-side filtering left commented out; server-side filtering via query string is used. --}}
    {{--
    <script>
        const institutionCards = document.querySelectorAll('.institution-card');
        const questionnaireItems = document.querySelectorAll('.questionnaire-item');
        
        institutionCards.forEach(card => {
            card.addEventListener('click', function(e) {
                // If you ever switch back to client-side filtering, prevent link navigation
                // e.preventDefault();
                institutionCards.forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                const selectedInstitution = this.getAttribute('data-institution');
                document.getElementById('institution-title').textContent = selectedInstitution === 'all' ? 'All Institutions' : this.querySelector('h4').textContent;
                questionnaireItems.forEach(item => {
                    item.style.display = (selectedInstitution === 'all' || item.getAttribute('data-institution') === selectedInstitution) ? 'block' : 'none';
                });
            });
        });
    </script>
    --}}
@endpush
