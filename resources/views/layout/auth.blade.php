<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    @section('title')
        Login - ARCHLIB
    @show
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Consistent Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-5xl mx-auto p-4">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold text-gray-800">ARCHLIB</h1>
            </div>
        </div>
    </header>

    <main class="max-w-md mx-auto p-4 mt-12">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Welcome Back</h2>
                <p class="text-gray-600 mt-2">Continue your knowledge journey</p>
            </div>

            @yield('forms')
            {{-- <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" required 
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" required 
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-700">Forgot password?</a>
                </div>

                <button type="submit" 
                        class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Log In
                </button>

                <p class="text-center text-gray-600 mt-4">
                    New to ARCHLIB? 
                    <a href="signup.html" class="text-blue-600 hover:text-blue-700">Create account</a>
                </p>
            </form> --}}
        </div>
    </main>
</body>
</html>