@extends('layout.main')
@section('title','Manage Tickets')
{{-- @section('heading','Manage Tickets') --}}
@section('main')
{{-- @dd($system) --}}
<div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-4 sm:mb-6">
        <h2 class="text-lg sm:text-xl font-bold text-gray-800 flex items-center mb-2 sm:mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
            </svg>
            {{ ucwords($system->name) }}
        </h2>
        <a href="#" class="text-sm text-blue-600 font-medium hover:underline">View All</a>
    </div>

    <!-- Table for Desktop -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="min-w-full text-sm text-gray-700">
            <thead>
                <tr class="bg-gray-50 border-b text-xs uppercase text-gray-500">
                    <th class="py-3 px-4 text-left">Code</th>
                    <th class="py-3 px-4 text-left">Permissions</th>
                    <th class="py-3 px-4 text-left">Expires</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($tickets as $ticket)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 font-mono text-blue-700">
                            <code class="bg-blue-50 px-2 py-1 rounded">{{ $ticket->token }}</code>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 text-xs rounded-full font-semibold">
                                {{ ucwords($ticket->type) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-600">{{ $ticket->expires_at }}</td>
                        <td class="py-3 px-4">
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">
                                Active
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <button class="text-gray-500 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Card version for Mobile -->
    <div class="sm:hidden space-y-4">
        @foreach ($tickets as $ticket)
            <div class="border rounded-lg p-4 shadow-sm bg-gray-50">
                <div class="mb-2">
                    <span class="text-xs text-gray-500">Code</span>
                    <div class="font-mono text-blue-700 bg-blue-100 inline-block px-2 py-1 rounded text-sm">{{ $ticket->token }}</div>
                </div>
                <div class="mb-2">
                    <span class="text-xs text-gray-500">Permissions</span>
                    <div class="text-xs bg-blue-200 text-blue-900 inline-block px-2 py-1 rounded-full font-semibold">
                        {{ ucwords($ticket->type) }}
                    </div>
                </div>
                <div class="mb-2">
                    <span class="text-xs text-gray-500">Expires</span>
                    <div class="text-sm text-gray-700">{{ $ticket->expires_at }}</div>
                </div>
                <div class="mb-2">
                    <span class="text-xs text-gray-500">Status</span>
                    <div class="bg-green-100 text-green-800 text-xs inline-block px-2 py-1 rounded-full font-medium">Active</div>
                </div>
                <div class="flex justify-end">
                    <button class="text-gray-500 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection