@extends('layout.main')
@section('title','Ticket Setting')
{{-- @section('heading','Ticket Setting') --}}
@push('links')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#0ea5e9',
                        dark: '#1e293b',
                        light: '#f8fafc'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            /* background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); */
        }

        .card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .tag {
            font-size: 0.75rem;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }

        .tab-button {
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .tab-button.active {
            border-color: #2563eb;
            color: #2563eb;
        }

        .permission-chip {
            transition: all 0.2s ease;
        }

        .permission-chip:hover {
            background: #e0f2fe;
            transform: scale(1.05);
        }

        .ticket-preview {
            background: linear-gradient(135deg, #ffffff 0%, #f1f8ff 100%);
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .ticket-preview::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2563eb 0%, #0ea5e9 100%);
        }

        .ticket-preview::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 20px;
            width: 60px;
            height: 60px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23e0f2fe'%3E%3Cpath d='M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z'/%3E%3C/svg%3E");
            opacity: 0.5;
            transform: translateY(-50%);
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2563eb;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }
    </style>
@endpush
@section('main')
    <main class="max-w-5xl mx-auto px-4 py-8">
        <!-- Tab Navigation -->
        <div class="flex border-b border-gray-200 mb-8">
            <button id="create-tab" class="tab-button px-4 py-3 font-medium text-gray-600 active">
                <i class="fas fa-plus-circle mr-2"></i>Create New Ticket
            </button>
            <button id="register-tab" class="tab-button px-4 py-3 font-medium text-gray-600">
                <i class="fas fa-ticket-alt mr-2"></i>Register Existing Ticket
            </button>
        </div>

        <!-- Create Ticket Section -->
        <div id="create-section" @class(['space-y-8','hidden' => session()->has('TicketMsg')])>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Form Section -->
                <div class="bg-white card rounded-xl p-6">
                    <h2 class="text-xl font-bold text-dark mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create New Ticket
                    </h2>

                    <form class="space-y-5" method="post" action="{{route('create.tickets')}}">
                    @csrf
                    @method('POST')
                     <input type="hidden" name="type" id="permissionInput" value="viewer">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                            <x-error name='number'/>
                            <input type="number"
                                name="quantity"
                                value="{{old('quantity')}}"
                                   placeholder="Total Amount of tickets You Want"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-blue-200 focus:outline-none input-focus transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Usage Limit</label>
                            <x-error name="max_usage"/>
                            <small>* the total amount of users that can use this ticket.</small>
                            <input type="number"
                            name="max_usage"
                            value="{{old('number')}}"
                                   placeholder="Total Amount of tickets You Want"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-blue-200 focus:outline-none input-focus transition">
                        </div>

                        <div>
                        @if(count($systems))
                            <label class="block text-sm font-medium text-gray-700 mb-2">Issuing Institution</label>
                            <x-error name="system"/>
                            <select type="text" name="system"  placeholder="Comma-separated tags" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                @foreach($systems as $system)
                                    <option value="{{$system->id}}">{{$system->name}}</option>
                                @endforeach
                            </select>
                        @else
                        <div class="md:col-span-2 text-center py-2 text-gray-500" id="emptyState">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <p class="mb-4">No institutions found</p>
                            <a href="{{route('create.system')}}"
                            class="px-4 py-2 text-blue-600 hover:text-blue-700 border border-blue-600 rounded-full">
                                Create Your First Institution
                            </a>
                        </div>
                        @endif
                        </div>

                        <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Expiration Date</label>
    <x-error name="expires_at"/>
    <input type="datetime-local"
           name="expires_at"
           value="{{old('expires_at')}}"
           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-blue-200 focus:outline-none input-focus transition">
</div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Institutions Available with Tickets</label>
                            <small>* "Read-only" allows you to explore content, while "Read and Write" grants permission to contribute to this institution.</small>
                            <div class="grid grid-cols-2 gap-3 mt-3">
                                <div onclick="selectPermission('viewer', this)"
                                 class="permission-chip bg-blue-50 border border-blue-100 rounded-lg p-3 flex items-center cursor-pointer">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <span>Read-only</span>
                                </div>
                                <div onclick="selectPermission('contributor', this)"
                                 class="permission-chip bg-green-50 border border-green-100 rounded-lg p-3 flex items-center cursor-pointer">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-green-100 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <span>Read & Write</span>
                                </div>
                            </div>
                        </div>

                        <button {{ count($systems) == 0 ? 'disabled' : '' }} class="w-full mt-6 flex items-center justify-center py-3 px-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-300 {{ count($systems) == 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Generate Ticket
                        </button>
                    </form>
                </div>

                <!-- Preview Section -->
                <div class="bg-white card rounded-xl p-6">
                    <h2 class="text-xl font-bold text-dark mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Institutions Available with Tickets
                    </h2>

                    @forelse ($SystemsWithTickets as $system)
                    <a href="{{route('pages.manage.tickets',['id'=>$system->id])}}">
                    <div  class="ticket-preview p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-gray-800"></h3>
                            </div>
                        </div>

                        <p class="text-sm text-gray-600 mb-4">Issued by: {{$system->name}}</p>

                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="tag bg-purple-100 text-purple-800">
                                <i class="fas fa-lock mr-1"></i> Read-only
                            </span>
                            <span class="tag bg-yellow-100 text-yellow-800">
                                <i class="fas fa-users mr-1"></i> Multi-use
                            </span>
                        </div>
                    </div>
                    </a>
                    @empty
                    <div class="flex flex-col items-center justify-center p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl shadow-md">
                            <!-- Sad Teddy Bear SVG -->
                            <svg class="w-20 h-20 mb-4 text-gray-400 dark:text-gray-500" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="6" fill="#D1D5DB" />
                                <circle cx="44" cy="20" r="6" fill="#D1D5DB" />
                                <ellipse cx="32" cy="40" rx="16" ry="18" fill="#E5E7EB" />
                                <circle cx="26" cy="36" r="2" fill="#111827" />
                                <circle cx="38" cy="36" r="2" fill="#111827" />
                                <path d="M28 44c2 2 6 2 8 0" stroke="#6B7280" stroke-linecap="round" />
                                <path d="M30 48c1.5 2 4.5 2 6 0" stroke="#9CA3AF" stroke-linecap="round" />
                            </svg>

                            <!-- Message Text -->
                            <p class="text-gray-600 dark:text-gray-300 text-lg font-medium text-center">
                                No institutions created
                            </p>
                        </div>

                    @endforelse


                </div>
            </div>

            <!-- Recent Tickets -->

        </div>

        <!-- Register Ticket Section (Hidden by default) -->
        <div id="register-section" @if(session()->missing('TicketMsg')) class="hidden" @endif>
       @if (session()->has('Ticketmsg'))
            <div id="msg-card" class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-white/70 backdrop-blur-md shadow-lg text-blue-800 font-semibold px-6 py-3 rounded-xl transition-opacity duration-1000 opacity-100 z-50 mt-4 mx-4">
             {{Ucwords(session('Ticketmsg'))}}
            </div>
       @endif
            <div class="space-y-5 my-2">
            {{-- {{dd($tickets)}} --}}
            @forelse ($tickets as $ticket)

            <div class="ticket-card fade-in bg-white rounded-xl shadow-sm p-5 border-l-blue-400">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800"><a href="{{route('pages.institution',['name'=>SystemName($ticket->system)])}}">{{strtoupper(SystemName($ticket->system))}} Access</a></h3>
                                {{-- <p class="text-sm text-gray-600 mt-1">Massachusetts Institute of Technology</p> --}}
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <span class="tag bg-blue-100 text-blue-800">
                                <i class="far fa-calendar mr-1"></i> Created: {{$ticket->created_at}}
                            </span>
                            <span class="tag bg-purple-100 text-purple-800">
                                <i class="fas fa-lock mr-1"></i> {{Ucwords($ticket->type)}}
                            </span>
                            <span class="tag bg-gray-100 text-gray-800">
                                <i class="fas fa-hashtag mr-1"></i> {{$ticket->token}}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 md:mt-0 flex items-center space-x-3">
                        <span class="tag bg-green-100 text-green-800">
                            <span class="status-dot bg-green-500"></span> Active
                        </span>
                        <button class="text-gray-500 hover:text-primary p-2 rounded-full hover:bg-blue-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white p-6 rounded-2xl shadow-xl w-full text-center space-y-4 border border-blue-100">
                <div class="w-24 h-24 mx-auto">
                    <!-- Sad Puppy SVG (Blue Theme) -->
                    <svg viewBox="0 0 64 64" fill="none" class="w-full h-full">
                    <circle cx="32" cy="32" r="30" fill="#EFF6FF" stroke="#3B82F6" stroke-width="2"/>
                    <path d="M22 24c-3 0-5 2-5 4s1 3 3 3m22-7c3 0 5 2 5 4s-1 3-3 3" stroke="#3B82F6" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="24" cy="32" r="2" fill="#3B82F6"/>
                    <circle cx="40" cy="32" r="2" fill="#3B82F6"/>
                    <path d="M26 42c2 1.5 10 1.5 12 0" stroke="#3B82F6" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>

                <h2 class="text-xl font-bold text-blue-800">No Tickets Available</h2>
                <p class="text-sm text-blue-600">You havent Registered any Tickets.</p>
            </div>


            @endforelse
        </div>
            <div class="bg-white card rounded-xl p-6 my-5">
                <h2 class="text-xl font-bold text-dark mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    Register an Existing Ticket
                </h2>

                <div class="space-y-6 max-w-2xl mx-auto">
                <form id="myForm" method="GET" onsubmit="SubmitToken(event)">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ticket Code</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                            {{-- <x-error name=""> --}}
                            <input type="text"
                                    id="token"
                                   placeholder="Enter 16-digit ticket code"
                                   class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-blue-200 focus:outline-none input-focus transition">
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Enter the code provided by your institution or ticket issuer.</p>
                    </div>

                    <div class="p-5 bg-purple-50 rounded-lg border border-purple-100">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-purple-700">By registering this ticket, you agree to comply with the resource provider's terms of service. Misuse of access may result in revocation of privileges.</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full mt-4 flex items-center justify-center py-3 px-4 bg-gradient-to-r from-purple-600 to-indigo-700 hover:from-purple-700 hover:to-indigo-800 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Verify & Register Ticket
                    </button>
                </form>
                </div>
            </div>
        </div>

    </main>
@endsection
@push('scripts')
    <script>
function SubmitToken(event) {
    const id = document.getElementById('token').value;

    // Check if the input is empty
    if (!id) {
        event.preventDefault();
        alert('Please enter a token.');
        return;
    }

    // Set form action dynamically
    const form = document.getElementById('myForm');
    form.action = "/register-tickets/" + encodeURIComponent(id);
}
</script>

    <script>
        document.getElementById('create-tab').addEventListener('click', function() {
            document.getElementById('create-section').classList.remove('hidden');
            document.getElementById('register-section').classList.add('hidden');
            document.getElementById('create-tab').classList.add('active');
            document.getElementById('register-tab').classList.remove('active');
        });

        document.getElementById('register-tab').addEventListener('click', function() {
            document.getElementById('create-section').classList.add('hidden');
            document.getElementById('register-section').classList.remove('hidden');
            document.getElementById('create-tab').classList.remove('active');
            document.getElementById('register-tab').classList.add('active');
        });

        const chips = document.querySelectorAll('.permission-chip');
        chips.forEach(chip => {
            chip.addEventListener('click', function() {
                // Remove any existing active state
                chips.forEach(c => c.classList.remove('ring-2', 'ring-blue-500'));

                // Add active state to clicked chip
                this.classList.add('ring-2', 'ring-blue-500');
            });
        });

        // Set the first permission chip as active by default
        if (chips.length > 0) {
            chips[0].classList.add('ring-2', 'ring-blue-500');
        }
    </script>
        <script>
            function selectPermission(value, el) {
                // Update hidden input
                document.getElementById('permissionInput').value = value;

                // Remove "selected" styles from all
                document.querySelectorAll('.permission-chip').forEach(chip => {
                    chip.classList.remove('ring-2', 'ring-offset-2', 'ring-blue-400', 'ring-green-400');
                });

                // Add selected style
                el.classList.add('ring-2', 'ring-offset-2', value === 'read' ? 'ring-blue-400' : 'ring-green-400');
            }

            function setPermission() {
                const val = document.getElementById('permissionInput').value;
                if (!val) {
                    alert("Please select a permission type.");
                    return false;
                }
                return true;
            }
        </script>
        
            <script>
            window.addEventListener("load", () => {
                setTimeout(() => {
                const card = document.getElementById("msg-card");
                card.classList.add("opacity-0");
                }, 10000); // 10 seconds
            });
            </script>
@endpush
