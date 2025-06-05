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
        <div class="max-w-5xl mx-auto p-4">
            <div class="flex items-center space-x-4">
            <a class="text-2xl font-bold text-gray-800" href='{{route('index')}}' >@section('heading') Archlib @show</a>
                <div class="flex-1">
                    <input type="text"
                           placeholder="Search archive..."
                           class="w-full px-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>
        </div>
    </header>
    @yield('main')
    @stack('scripts')
    @livewireScripts
</body>
</html>
