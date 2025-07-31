<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHLIB Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <!-- Main Title -->
        <h1 class="text-6xl font-bold text-gray-800 mb-4 text-center">
            ARCHLIB
            <span class="block text-2xl font-normal text-gray-600 mt-2"> <h3>Welcome</h3>{{Auth::user()->username}}</span>
        </h1>

        <!-- Search Box -->
        <div class="max-w-2xl w-full px-4 mb-8">
            <div class="relative">
            <form id="searchForm" method="GET" onsubmit="updateAction(event)">
                <input type="text"
                    id="queryInput"
                    class="w-full px-6 py-4 text-lg rounded-full border border-gray-200 focus:outline-none focus:border-gray-300 focus:shadow-lg transition-all"
                    placeholder="Search the archive...">
            </form>
            </div>
        </div>

        <!-- Floating Create Button -->
        <button onclick="toggleCreationMenu()"
                class="fixed bottom-8 right-8 w-16 h-16 rounded-full bg-blue-600 hover:bg-blue-700 text-white shadow-lg transition-all flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </button>

        <!-- Creation Menu Overlay -->
        <div id="creationMenu" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-xl p-8 max-w-2xl w-full mx-4">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Create New</h2>
                    <button onclick="toggleCreationMenu()" class="text-gray-500 hover:text-gray-700">
                        ✕
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{route('create.note')}}" class="p-6 text-left rounded-lg border-2 border-blue-100 hover:border-blue-200 hover:bg-blue-50 transition-all">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                📝
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">New Note</h3>
                                <p class="text-sm text-gray-600">Create text-based notes</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{route('create.resources')}}" class="p-6 text-left rounded-lg border-2 border-blue-100 hover:border-blue-200 hover:bg-blue-50 transition-all">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                📁
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">New Resource</h3>
                                <p class="text-sm text-gray-600">Upload files or links</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{route('create.questionaires')}}" class="p-6 text-left rounded-lg border-2 border-blue-100 hover:border-blue-200 hover:bg-blue-50 transition-all">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                📁
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">New Questionaire</h3>
                                <p class="text-sm text-gray-600">Create New Questionaire</p>
                            </div>
                        </div>
                    </a>

                    <!-- New Institution Option -->
                    <a href="{{route('create.system')}}" class="p-6 text-left rounded-lg border-2 border-blue-100 hover:border-blue-200 hover:bg-blue-50 transition-all">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                🏛️
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Create Institution</h3>
                                <p class="text-sm text-gray-600">Set up organization space</p>
                            </div>
                        </div>
                    </a>

                    <!-- Ticket Registration -->
                    <a
                     href="{{route('pages.ticket-settings')}}"
                     class="p-6 text-left rounded-lg border-2 border-blue-100 hover:border-blue-200 hover:bg-blue-50 transition-all">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                🎟️
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Register Ticket</h3>
                                <p class="text-sm text-gray-600">Activate access token</p>
                            </div>
                        </div>
                    </a>
                {{-- <a href="{{route('pages.myInstitutions')}}" class="p-6 text-left rounded-lg border-2 border-green-100 hover:border-green-200 hover:bg-green-50 transition-all">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            🗂️
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Manage My Institutions</h3>
                            <p class="text-sm text-gray-600">View or edit existing setups</p>
                        </div>
                    </div>
                </a> --}}
            <a href="{{ route('pages.manage') }}" class="p-6 text-left rounded-lg border-2 border-green-100 hover:border-green-200 hover:bg-green-50 transition-all">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        🗂️
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Manage Institutions & More</h3>
                        <p class="text-sm text-gray-600">Institutions, resources, questionnaires, and notes</p>
                    </div>
                </div>
            </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCreationMenu() {
            const menu = document.getElementById('creationMenu');
            menu.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }
    </script>
    <script>
    function updateAction(event) {
        const input = document.getElementById('queryInput').value.trim();
        if (!input) {
            event.preventDefault(); // block submission if empty
            return;
        }

        // update form action before submit
        const form = document.getElementById('searchForm');
        form.action = '/search/result/' + input; // e.g. /books or /resources/my-query
    }
</script>
</body>
</html>
