<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    <!-- Dropify Dependencies -->
    @stack('links')
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
<header class="bg-white shadow-sm flex items-center justify-between px-4 py-3 relative">
    <!-- Left: Static Logo -->
    <a href="{{ route('index') }}" class="text-xl sm:text-2xl font-bold text-gray-800">
        ARCHLIB
    </a>

    <!-- Center: Page Heading -->
    <div class="absolute left-1/2 transform -translate-x-1/2 hidden sm:block">
        <div class="text-xl font-bold text-gray-800">
            @yield('heading')
        </div>
    </div>

    <!-- Right: Hamburger Menu -->
    <div class="sm:hidden relative">
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
    <!-- Right: Icons (desktop only) -->
<div class="hidden sm:flex items-center space-x-4">
    <!-- Search Icon -->
    <a href="#" class="text-gray-600 hover:text-gray-800">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
        </svg>
    </a>

    <!-- Bell (Notifications) Icon -->
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
