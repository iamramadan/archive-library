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
                <input type="text"
                       placeholder="Search archive..."
                       class="w-full px-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:border-blue-500">
            </div>
        </div>

        <!-- Right: Icons -->
        <div class="hidden sm:flex items-center space-x-4 my-2">
            <!-- Search Icon -->
            <a href="#" class="text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                </svg>
            </a>

            <!-- Notifications Icon -->
            <a href="#" class="text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-9.33-4.97M6 9v1m0 0a6 6 0 000 3v1.158c0 .538-.214 1.055-.595 1.437L4 17h5m6 0v1a3 3 0 11-6 0v-1" />
                </svg>
            </a>

            <!-- User Icon -->
            <a href="#" class="text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5.121 17.804A9.003 9.003 0 0112 15a9.003 9.003 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
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
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Home</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Library</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
            </div>
        </div>
    </div>
</header>

    @yield('main')
    @stack('scripts')
    @livewireScripts
    <script>
    const btn = document.getElementById('mobileMenuBtn');
    const dropdown = document.getElementById('mobileDropdown');

    btn.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });
</script>
</body>
</html>
