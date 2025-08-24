<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - Lawin & Partners</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-primary/5 via-accent to-secondary/5 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        {{-- Header --}}
        <div class="text-center">
            <div class="mx-auto w-24 h-24 bg-gradient-to-br from-primary to-secondary rounded-3xl flex items-center justify-center shadow-2xl border-4 border-white/20">
                <svg class="w-12 h-12 text-white" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9,2V8H11V22H5V16H3V22H1V16C1,14.89 1.89,14 3,14H5V8A6,6 0 0,1 11,2H13A6,6 0 0,1 19,8V14H21C22.11,14 23,14.89 23,16V22H21V16H19V22H13V8H15V2H9M7,4H9V6H7V4M15,4H17V6H15V4Z"/>
                </svg>
            </div>
            <div class="mt-6">
                <h1 class="text-4xl font-bold text-primary mb-2">Lawin & Partners</h1>
                <p class="text-lg text-secondary font-semibold mb-1">Legal Excellence Since 1985</p>
            </div>
            <div class="mt-4">
                <h2 class="text-2xl font-bold text-gray-900">Admin Portal</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Sign in to access the administrative dashboard
                </p>
            </div>
        </div>

        {{-- Login Form --}}
        <form class="mt-8 space-y-6" action="{{ route('admin.login.post') }}" method="POST">
            @csrf
                <div class="bg-white rounded-2xl shadow-2xl p-8 space-y-6 border border-gray-100">
                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-400 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Login Error</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 12.713l-11.985-9.713h23.97l-11.985 9.713zm0 2.574l-12-9.725v15.438h24v-15.438l-12 9.725z"/>
                            </svg>
                        </div>
                        <input id="email" 
                               name="email" 
                               type="email" 
                               autocomplete="email" 
                               required 
                               value="{{ old('email') }}"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-150 ease-in-out @error('email') border-red-300 @enderror" 
                               placeholder="Enter your email address">
                    </div>
                </div>

                {{-- Password Field --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M6 8V7C6 5.9 6.9 5 8 5H16C17.1 5 18 5.9 18 7V8H19C19.6 8 20 8.4 20 9V19C20 19.6 19.6 20 19 20H5C4.4 20 4 19.6 4 19V9C4 8.4 4.4 8 5 8H6M8 7V8H16V7C16 6.4 15.6 6 15 6H9C8.4 6 8 6.4 8 7Z"/>
                            </svg>
                        </div>
                        <input id="password" 
                               name="password" 
                               type="password" 
                               autocomplete="current-password" 
                               required 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-150 ease-in-out @error('password') border-red-300 @enderror" 
                               placeholder="Enter your password">
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" 
                               name="remember" 
                               type="checkbox" 
                               class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-primary to-primary/80 hover:from-primary/90 hover:to-primary/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transform transition duration-150 ease-in-out hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-white/80 group-hover:text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10C8.89,22 8,21.1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z"/>
                            </svg>
                        </span>
                        Access Admin Portal
                    </button>
                </div>

                {{-- Register Link --}}
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Need administrator access? 
                        <a href="{{ route('admin.register') }}" class="font-semibold text-primary hover:text-secondary transition duration-150 ease-in-out">
                            Request Account
                        </a>
                    </p>
                </div>
            </div>
        </form>

        {{-- Back to Website --}}
        <div class="text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-primary transition duration-150 ease-in-out">
                <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                </svg>
                Back to Lawin & Partners Website
            </a>
        </div>
    </div>
</body>
</html>
