<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Dropify Dependencies -->
    @stack('links')
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-5xl mx-auto p-4">
            <a class="text-2xl font-bold text-gray-800" href='{{route('index')}}' >@yield('heading')</a>
        </div>
    </header>

    @yield('main')
    @stack('scripts')
</body>
</html>