<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('meta_tags')
        <title>{{ $title ?? 'Admin Panel' }}</title>
    @show
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.min.css" integrity="sha512-ykRBEJhyZ+B/BIJcBuOyUoIxh0OfdICfHPnPfBy7eIiyJv536ojTCsgX8aqrLQ9VJZHGz4tvYyzOM0lkgmQZGw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
    <style>
        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Sidebar collapse behavior */
        @media (min-width: 768px) {
            .sidebar {
                width: 18rem; /* w-72 */
            }
            .main-content {
                margin-left: 18rem; /* ml-72 */
            }
            .sidebar-collapsed .sidebar {
                width: 5rem; /* w-20 */
            }
            .sidebar-collapsed .main-content {
                margin-left: 5rem; /* ml-20 */
            }
            .sidebar-collapsed .hide-when-collapsed {
                display: none !important;
            }
            .sidebar-collapsed .nav-item {
                justify-content: center;
            }
            .sidebar-collapsed .nav-item .icon {
                margin-right: 0 !important;
            }
            .sidebar-collapsed .sidebar-scroll {
                padding-left: 0.5rem !important; /* px-2 */
                padding-right: 0.5rem !important;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50 antialiased text-gray-600">
    <!-- Mobile menu overlay -->
    <div id="mobile-menu-overlay" class="fixed inset-0 z-50 hidden md:hidden">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" onclick="toggleMobileMenu()"></div>
        <div
            class="fixed inset-y-0 left-0 flex flex-col max-w-xs w-full bg-white shadow-xl transform transition-transform">
            <!-- Mobile sidebar content -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center border border-gray-200">
                        <svg class="w-6 h-6 text-gray-700" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M9,2V8H11V22H5V16H3V22H1V16C1,14.89 1.89,14 3,14H5V8A6,6 0 0,1 11,2H13A6,6 0 0,1 19,8V14H21C22.11,14 23,14.89 23,16V22H21V16H19V22H13V8H15V2H9M7,4H9V6H7V4M15,4H17V6H15V4Z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Admin Panel</h2>
                        <p class="text-xs text-gray-500">{{ config('app.name') }}</p>
                    </div>
                </div>
                <button onclick="toggleMobileMenu()"
                    class="p-2 text-gray-500 hover:text-gray-700 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
                @include('layouts.partials.admin-nav')
            </nav>
            <!-- Mobile user section -->
            <div class="border-t border-white/20 p-4">
                @include('layouts.partials.admin-user')
            </div>
        </div>
    </div>

    <div class="min-h-screen flex">
        <!-- Desktop Sidebar -->
        <aside class="hidden md:flex md:flex-col md:fixed md:inset-y-0 z-30 sidebar">
            <div class="flex flex-col flex-grow bg-white shadow-xl">
                <!-- Sidebar Header -->
                <div class="flex items-center gap-4 p-6 border-b border-gray-200">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center border border-gray-200">
                        <svg class="w-7 h-7 text-gray-700" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M9,2V8H11V22H5V16H3V22H1V16C1,14.89 1.89,14 3,14H5V8A6,6 0 0,1 11,2H13A6,6 0 0,1 19,8V14H21C22.11,14 23,14.89 23,16V22H21V16H19V22H13V8H15V2H9M7,4H9V6H7V4M15,4H17V6H15V4Z" />
                        </svg>
                    </div>
                    <div class="hide-when-collapsed">
                        <h2 class="text-xl font-bold text-gray-900">Admin Panel</h2>
                        <p class="text-sm text-gray-500">{{ config('app.name') }}</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto sidebar-scroll">
                    @include('layouts.partials.admin-nav')
                </nav>

                <!-- User Section -->
                <div class="border-t border-gray-200 p-4 hide-when-collapsed">
                    @include('layouts.partials.admin-user')
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 main-content">
            <!-- Mobile Header -->
            <header class="md:hidden bg-white shadow-sm border-b">
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center gap-3">
                        <button onclick="toggleMobileMenu()"
                            class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h1 class="text-lg font-semibold text-gray-900">{{ $header ?? 'Admin Panel' }}</h1>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600 hidden sm:block">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span
                                class="text-xs font-semibold text-white">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Desktop Header -->
            <header class="hidden md:block sticky top-0 z-10 bg-white/80 backdrop-blur-xl border-b border-gray-200">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="w-full">
                            <div class="flex items-center gap-3">
                                <button id="sidebar-toggle" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors" aria-label="Toggle sidebar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8M4 18h16"></path>
                                    </svg>
                                </button>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $header ?? 'Dashboard' }}</h1>
                            </div>
                            @if (isset($breadcrumbs))
                                <nav class="flex mt-1" aria-label="Breadcrumb">
                                    <ol class="flex items-center space-x-2 text-sm text-gray-500">
                                        @foreach ($breadcrumbs as $breadcrumb)
                                            <li class="flex items-center">
                                                @if (!$loop->last)
                                                    <a href="{{ $breadcrumb['url'] }}"
                                                        class="hover:text-gray-700">{{ $breadcrumb['title'] }}</a>
                                                    <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                @else
                                                    <span class="text-gray-700">{{ $breadcrumb['title'] }}</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ol>
                                </nav>
                            @endif
                        </div>
                        <div class="flex items-center gap-4">
                            <!-- Notifications -->
                            <button
                                class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors relative">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-5 5v-5zM15 17H9a6 6 0 010-12h6a6 6 0 016 6v3z"></path>
                                </svg>
                                <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                            </button>

                            <!-- User Menu -->
                            <div class="flex items-center gap-3">
                                <div class="text-right hidden sm:block">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ auth()->user()->name ?? 'Administrator' }}</p>
                                    <p class="text-xs text-gray-500">Administrator</p>
                                </div>
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span
                                        class="text-sm font-semibold text-white">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mx-6 mt-4">
                        <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <button type="button" class="inline-flex text-green-400 hover:text-green-600"
                                        onclick="this.parentElement.parentElement.parentElement.parentElement.remove()">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mx-6 mt-4">
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <button type="button" class="inline-flex text-red-400 hover:text-red-600"
                                        onclick="this.parentElement.parentElement.parentElement.parentElement.remove()">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Page Content -->
                <div class="p-6">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between text-sm text-gray-500">
                <div>
                    &copy; {{ date('Y') }} {{ config('app.name') }} Admin Panel. All rights reserved.
                </div>
                <div class="flex items-center gap-4">
                    <span>Version 1.0</span>
                    <a href="#" class="hover:text-gray-700">Support</a>
                </div>
            </div>
        </div>
    </footer>
    @stack('scripts')
    <!-- JavaScript for mobile menu -->
    <script>
        function toggleMobileMenu() {
            const overlay = document.getElementById('mobile-menu-overlay');
            overlay.classList.toggle('hidden');
        }

        // Sidebar collapse toggle (desktop)
        function applySidebarPreference() {
            try {
                const collapsed = localStorage.getItem('sidebarCollapsed');
                if (collapsed === 'true') {
                    document.body.classList.add('sidebar-collapsed');
                }
            } catch (e) { /* ignore */ }
        }

        function toggleSidebar() {
            document.body.classList.toggle('sidebar-collapsed');
            try {
                localStorage.setItem('sidebarCollapsed', document.body.classList.contains('sidebar-collapsed'));
            } catch (e) { /* ignore */ }
        }

        document.addEventListener('DOMContentLoaded', function() {
            applySidebarPreference();
            const btn = document.getElementById('sidebar-toggle');
            if (btn) {
                btn.addEventListener('click', toggleSidebar);
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu-overlay');
            if (event.target === mobileMenu) {
                toggleMobileMenu();
            }
        });
   
    </script>
</body>

</html>
