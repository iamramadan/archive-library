<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @stack('links')
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header (Consistent with previous pages) -->
<header class="bg-white shadow-sm">
    <div class="max-w-5xl mx-auto p-4 flex items-center justify-between">
        <!-- Left: Logo + Search -->
        <div class="flex items-center space-x-4 flex-1">
            <a class="text-2xl font-bold text-gray-800 whitespace-nowrap" href="{{ route('index') }}">
                @section('heading') Archlib @show
            </a>
            <div class="flex-1 hidden sm:block">
            <form  id="searchForm" method="GET" onsubmit="updateAction(event)">
                <input type="text"
                       placeholder="Search archive..."
                       class="w-full px-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:border-blue-500">
            </form>
            </div>
        </div>

        <!-- Right: Icons -->
            <div class="hidden sm:flex items-center space-x-4 mx-5 my-2">

                <!-- Manage Content Icon -->
                <a href="{{ route('pages.manage') }}" class="text-gray-600 hover:text-gray-800" title="Manage Content">
                    <i class="fas fa-folder-open text-lg"></i>
                </a>

                <!-- Ticket Manager Icon -->
                <a href="{{ route('pages.ticket-settings') }}" class="text-gray-600 hover:text-gray-800" title="Ticket Manager">
                    <i class="fas fa-ticket-alt text-lg"></i>
                </a>

                <!-- Back Icon -->
                <a href="{{url()->previous()}}" class="text-gray-600 hover:text-gray-800" title="Back">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>

                <div class="relative inline-block text-left group">
                <!-- Dropdown Button -->
                <button
                    class="inline-flex justify-center items-center w-full px-4 py-2 text-sm font-medium  bg-gray-500 text-white  rounded-md focus:outline-none"
                >
                    <i class="fas fa-plus"></i>
                    <!-- SVG chevron icon -->
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu (shown on hover) -->
                <div
                    class="absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block z-10"
                >
                    <div class="py-1">
                    <a href="{{route('create.note')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Create Notes
                    </a>
                    <a href="{{route('create.resources')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Resources
                    </a>
                    <a href="{{route('create.questionaires')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Questionnaire
                    </a>
                    </div>
                </div>
                </div>

            </div>

        <!-- Mobile Menu Button -->
        <div class="sm:hidden relative ml-2">
            <button id="mobileMenuBtn" class="text-gray-700 focus:outline-none">
                <!-- Heroicons menu icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="mobileDropdown" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden z-50">
                <a href="{{route('pages.manage')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Content Manager</a>
                <a href="{{route('pages.ticket-settings')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Ticket Settings</a>
                <a href="{{ url()->previous() }} " class="block px-4 py-2 text-gray-700 hover:bg-gray-100">&larr; Back</a>
            </div>
        </div>s
    </div>
</header>

    @yield('main')
    @stack('scripts')
    @livewireScripts
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
<script>
    const btn = document.getElementById('mobileMenuBtn');
    const dropdown = document.getElementById('mobileDropdown');

    btn.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });
</script>

</body>
</html>
