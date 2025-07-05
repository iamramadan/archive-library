@extends('layout.main')
@section('title','Manage Tickets')
@section('heading','Manage Tickets')
@section('main')
    <div class="bg-white card rounded-xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-dark flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        {{Ucwords($system->name)}}
                    </h2>
                    <button class="text-sm text-primary font-medium hover:text-blue-700">
                        View All
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-sm text-gray-500 border-b">
                                <th class="pb-3">Code</th>
                                <th class="pb-3">Permissions</th>
                                <th class="pb-3">Expires</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                        @foreach ($system->tickets as $ticket)
                            
                        @endforeach
                            <tr>
                                <td class="py-4">
                                    <code class="text-sm bg-gray-100 px-2 py-1 rounded">{{$ticket->token}}</code>
                                </td>
                                <td class="py-4">
                                    <span class="tag bg-blue-100 text-blue-800">{{Ucwords($ticket->type)}}</span>
                                </td>
                                <td class="py-4">
                                    <span class="text-gray-600">{{$ticket->expires_at}}</span>
                                </td>
                                <td class="py-4">
                                    <span class="tag bg-green-100 text-green-800">Active</span>
                                </td>
                                <td class="py-4">
                                    <button class="text-gray-500 hover:text-primary p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    </div>
@endsection