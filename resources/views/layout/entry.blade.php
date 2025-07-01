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
    <header class="bg-white shadow-sm flex items-center justify-between px-4 py-3">
    <!-- Left: Static Logo -->
    <a href="{{ route('index') }}" class="text-xl sm:text-2xl font-bold text-gray-800">
        ARCHLIB
    </a>

    <!-- Center: Page Heading (Centered on larger screens) -->
    <div class="absolute left-1/2 transform -translate-x-1/2 hidden sm:block">
        <div  class="text-xl font-bold text-gray-800">
            @yield('heading')
        </div>
    </div>

    <!-- Optional: Add right-side icons or user menu here -->
    <div class="sm:hidden">
        <!-- You can place a hamburger menu icon for mobile here if needed -->
    </div>
</header>


    @yield('main')
    @stack('scripts')
    @livewireScripts
</body>
</html>
