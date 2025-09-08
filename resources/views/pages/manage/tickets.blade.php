@extends('layout.main')
@section('title','Manage Tickets')
@section('main')

<div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-4 sm:mb-6">
        <h2 class="text-lg sm:text-xl font-bold text-gray-800 flex items-center mb-2 sm:mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
            </svg>
            {{ ucwords($system->name) }}
        </h2>
        <div class="flex items-center space-x-2">
            <a href="{{route('pages.ticket-settings')}}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                New Ticket
            </a>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
        <div class="bg-blue-50 p-3 rounded-lg border border-blue-100">
            <div class="text-blue-800 font-medium">Showing Tickets</div>
            <div class="text-2xl font-bold text-blue-600">{{$tickets->count()}}</div>
        </div>
        <div class="bg-green-50 p-3 rounded-lg border border-green-100">
            <div class="text-green-800 font-medium">Collaborators</div>
            <div class="text-2xl font-bold text-green-600">{{$tickets->where('type','contributor')->count()}}</div>
        </div>
        <div class="bg-red-50 p-3 rounded-lg border border-red-100">
            <div class="text-red-800 font-medium">Expired</div>
            <div class="text-2xl font-bold text-red-600">{{$tickets->where('expires_at','<',now())->count()}}</div>
        </div>
    </div>

    <!-- Search and Filter -->
    

    <!-- Desktop Table -->
    <div class="hidden sm:block overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-50">
                <tr class="text-xs uppercase text-gray-500">
                    <th class="py-3 px-4 text-left">Code</th>
                    <th class="py-3 px-4 text-left">Permissions</th>
                    <th class="py-3 px-4 text-left">Created</th>
                    <th class="py-3 px-4 text-left">Expires</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($tickets as $ticket)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <code class="bg-blue-50 px-3 py-1 rounded font-mono text-blue-700">{{ $ticket->token }}</code>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 text-xs rounded-full font-semibold">
                                {{ ucwords($ticket->type) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-600">{{ date('d M Y', strtotime($ticket->created_at)) }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ date('d M Y', strtotime($ticket->expires_at)) }}</td>
                        <td class="py-3 px-4">
                            @if(strtotime($ticket->expires_at) > time())
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                    Active
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">
                                    Expired
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex justify-center space-x-2">
                                <button onclick="copyToClipboard('{{ $ticket->token }}')" class="text-gray-500 hover:text-blue-600 p-1 rounded-full hover:bg-blue-50" title="Copy Ticket">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>

                                <form method="POST" action="{{ route('delete.ticket', $ticket->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-red-600 p-1 rounded-full hover:bg-red-50" title="Delete Ticket" onclick="return confirm('Are you sure you want to delete this ticket?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mobile Cards -->
    <div class="sm:hidden space-y-4">
        @foreach ($tickets as $ticket)
            <div class="border rounded-lg p-4 shadow-sm bg-white">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <span class="text-xs text-gray-500">Code</span>
                        <div class="font-mono text-blue-700 text-sm">{{ $ticket->token }}</div>
                    </div>
                    <div>
                        @if(strtotime($ticket->expires_at) > time())
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">Active</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">Expired</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div>
                        <span class="text-xs text-gray-500">Permissions</span>
                        <div class="text-xs bg-blue-200 text-blue-900 px-2 py-1 rounded-full font-semibold">
                            {{ ucwords($ticket->type) }}
                        </div>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500">Created</span>
                        <div class="text-sm text-gray-700">{{ date('d M Y', strtotime($ticket->created_at)) }}</div>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500">Expires</span>
                        <div class="text-sm text-gray-700">{{ date('d M Y', strtotime($ticket->expires_at)) }}</div>
                    </div>
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <button onclick="copyToClipboard('{{ $ticket->token }}')" class="text-gray-500 hover:text-blue-600 p-1 rounded-full hover:bg-blue-50" title="Copy Ticket">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </button>

                    <form method="POST" action="{{ route('delete.ticket', $ticket->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-500 hover:text-red-600 p-1 rounded-full hover:bg-red-50" title="Delete Ticket" onclick="return confirm('Are you sure you want to delete this ticket?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    {{ $tickets->links('pagination::tailwind') }}
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // Show success message
            const alertDiv = document.createElement('div');
            alertDiv.className = 'fixed top-4 right-4 px-4 py-2 bg-green-500 text-white rounded-md shadow-lg flex items-center';
            alertDiv.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                Copied to clipboard!
            `;

            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.remove();
            }, 2000);
        });
    }
</script>

@endsection
