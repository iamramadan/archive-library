@extends('layout.auth')
@section('title')
        SIGNUP - ARCHLIB
@endsection
@section('forms')
    <form class="space-y-4" action="{{route('auth.signup')}}"  method="POST">
        @csrf
                <div>
                    @if($errors->has('email'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('email') }}</p>
                    @endif
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" required value="{{old('email')}}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
                <div>
                    @if($errors->has('username'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('username') }}</p>
                    @endif
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" value="{{old('username')}}" required 
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                        @if($errors->has('password'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('password') }}</p>
                        @endif
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required value="{{old('password')}}" 
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
                <div>
                    @if($errors->has('password_confirmation'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required 
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
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
                    <a href="{{route('auth.signinpage')}}" class="text-blue-600 hover:text-blue-700">Create account</a>
                </p>
    </form>
@endsection