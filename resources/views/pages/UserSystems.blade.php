@extends('layout.main')
@section('title','My-Institutions')
@section('heading','My Institutions')
@section('main')
    <main class="max-w-3xl mx-auto p-4 mt-8">
        <!-- Create New Button -->
        <div class="mb-8 text-right">
            <a href="{{route('create.system')}}"
               class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                Create New Institution
            </a>
        </div>

        <!-- Institutions Grid -->
        @if ($institutionsData->count() == 0)
            <div class="md:col-span-2 text-center py-12 text-gray-500" id="emptyState" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <p class="mb-4">No institutions found</p>
                <a href="{{route('create.system')}}"
                   class="px-4 py-2 text-blue-600 hover:text-blue-700 border border-blue-600 rounded-full">
                    Create Your First Institution
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Institution Card -->
            @foreach ($institutionsData as $institute)
            {{-- <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <x-image name="{{$institute->logo}}" class="w-16 h-16 rounded-lg"/>
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{$institute->name}}</h2>
                        <p class="text-sm text-gray-600 mb-4">{{$institute->about}}</p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="space-x-2">
                                <span>📚  Resources</span>
                                <span>👥 245 Members</span>
                            </div>
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                Admin
                            </span>
                        </div>
                    </div>
                </div>
            </div> --}}
<div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow relative mb-6">
    {{-- Dropdown trigger and menu --}}
            <div class="absolute top-4 right-4">
                <div class="relative group">
                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        ⋮
                    </button>
                    <div class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-150 z-10">
                        <a href="{{route('update.system',['id'=>$institute->id])}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                        <a href="{{route('delete.confirm',['table'=>'institution','id'=>$institute->id])}}" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Delete</a>
                    </div>
                </div>
            </div>
            <a href="{{route('pages.institution',['name'=>$institute->name])}}">
                <div class="flex items-start gap-4">
                    <x-image name="{{ $institute->logo }}" class="w-16 h-16 rounded-lg" />
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $institute->name }}</h2>
                        <p class="text-sm text-gray-600 mb-4">{{ Str::limit($institute->about,50) }}</p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="space-x-2">
                                {{-- <span>📚 Resources</span> --}}
                                <span>👥 245 Members</span>
                            </div>
                            <a href="{{route('pages.institution',['name'=>$institute->name])}}" class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">View</a>
                        </div>
                    </div>
                </div>
            </a>
</div>

            @endforeach
            <!-- Empty State -->
        </div>
        @endif


    </main>
@endsection
@push('scripts')
    <script>
        // Simple empty state toggle (remove if implementing backend)
        const institutions = document.querySelectorAll('.bg-white.rounded-xl');
        const emptyState = document.getElementById('emptyState');

        if(institutions.length === 0) {
            emptyState.style.display = 'block';
        }
    </script>
@endpush
