@extends('layouts.admin')

@section('content')
{{-- Dashboard Welcome Section --}}
<div class="mb-8">
    <div class="bg-gradient-to-r from-indigo-500 via-purple-600 to-blue-700 rounded-2xl p-8 text-white">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold mb-2 text-gray-600">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="text-gray-600 text-lg mb-4">Here's what's happening with your plant breeding organization.</p>
                <div class="flex items-center gap-6 text-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                        <span class="text-gray-600">System Online</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                        </svg>
                        <span class="text-gray-600">Last login: {{ now()->format('M d, Y - h:i A') }}</span>
                    </div>
                </div>
            </div>
            <div class="hidden sm:flex items-center justify-center w-20 h-20 bg-white/20 rounded-2xl backdrop-blur-sm">
                <svg class="w-10 h-10" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9,2V8H11V22H5V16H3V22H1V16C1,14.89 1.89,14 3,14H5V8A6,6 0 0,1 11,2H13A6,6 0 0,1 19,8V14H21C22.11,14 23,14.89 23,16V22H21V16H19V22H13V8H15V2H9M7,4H9V6H7V4M15,4H17V6H15V4Z"/>
                </svg>
            </div>
        </div>
    </div>
</div>
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Users Card --}}
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Users</p>
                                <p class="text-2xl font-bold text-gray-600">{{ $stats['total_users'] ?? 0 }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    +12%
                                </span>
                                <p class="text-xs text-gray-500 mt-1">vs last month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Admin Users Card --}}
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M12,7C13.4,7 14.8,8.6 14.8,10V11H12V15H16V10A4,4 0 0,0 8,10V15H9.2V11H7V10C7,8.6 8.6,7 12,7Z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Admin Users</p>
                                <p class="text-2xl font-bold text-gray-600">{{ $stats['admin_users'] ?? 0 }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Active
                                </span>
                                <p class="text-xs text-gray-500 mt-1">privileged access</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Profile Status Card --}}
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-{{ $stats['profile_exists'] ? 'green' : 'orange' }}-500 to-{{ $stats['profile_exists'] ? 'green' : 'orange' }}-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                                @if($stats['profile_exists'])
                                    <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                                @else
                                    <path d="M13,14H11V10H13M13,18H11V16H13M1,21H23L12,2L1,21Z"/>
                                @endif
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Organization Profile</p>
                                <p class="text-2xl font-bold text-gray-600">{{ $stats['profile_exists'] ? 'Complete' : 'Pending' }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $stats['profile_exists'] ? 'green' : 'yellow' }}-100 text-{{ $stats['profile_exists'] ? 'green' : 'yellow' }}-800">
                                    {{ $stats['profile_exists'] ? 'Updated' : 'Setup Required' }}
                                </span>
                                @if(!$stats['profile_exists'])
                                    <a href="{{ route('admin.profile.create') }}" class="text-xs text-primary hover:text-secondary mt-1 block">Setup Now →</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- System Status Card --}}
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">System Status</p>
                                <p class="text-2xl font-bold text-gray-600">Healthy</p>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-1"></div>
                                    <span class="text-xs text-green-600 font-medium">Online</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">All systems operational</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts and Analytics Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        {{-- User Growth Chart --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-600">User Growth</h3>
                    <p class="text-sm text-gray-600">Monthly user registration trends</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-primary rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">New Users</span>
                    </div>
                </div>
            </div>
            <div class="h-64 flex items-end justify-between space-x-2">
                {{-- Simple Bar Chart Simulation --}}
                @php
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    $values = [45, 52, 38, 67, 78, 85, 92, 87, 95, 105, 115, 125];
                @endphp
                @foreach($months as $index => $month)
                    <div class="flex flex-col items-center flex-1">
                        <div class="bg-gradient-to-t from-primary to-primary/70 rounded-t-sm w-full hover:from-primary/80 hover:to-primary/50 transition-colors duration-200" 
                             style="height: {{ ($values[$index] / max($values)) * 200 }}px;"></div>
                        <span class="text-xs text-gray-600 mt-2">{{ $month }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Recent Activities --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-600">Recent Activities</h3>
                    <p class="text-sm text-gray-600">Latest system activities and updates</p>
                </div>
                <button class="text-sm text-primary hover:text-secondary font-medium">View All</button>
            </div>
            <div class="space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-600">New user registered</p>
                        <p class="text-xs text-gray-500">Dr. Sarah Johnson joined as a member</p>
                        <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-600">Profile updated</p>
                        <p class="text-xs text-gray-500">Organization profile information was updated</p>
                        <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-600">New publication</p>
                        <p class="text-xs text-gray-500">Research paper on "Genetic Diversity in Rice" published</p>
                        <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-yellow-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-600">Event scheduled</p>
                        <p class="text-xs text-gray-500">Annual Plant Breeding Conference 2024 announced</p>
                        <p class="text-xs text-gray-400 mt-1">2 days ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions and System Info --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Quick Actions --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-600 mb-6">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.profile.edit') }}" class="group p-4 border border-gray-200 rounded-xl hover:border-primary hover:bg-primary/5 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-600">Edit Profile</p>
                                <p class="text-sm text-gray-600">Update organization details</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.profile.index') }}" class="group p-4 border border-gray-200 rounded-xl hover:border-secondary hover:bg-secondary/5 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-secondary to-accent rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-600">View Profile</p>
                                <p class="text-sm text-gray-600">Check current settings</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('/') }}" target="_blank" class="group p-4 border border-gray-200 rounded-xl hover:border-accent hover:bg-accent/5 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-accent to-primary rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M7.07,18.28C7.5,17.38 10.12,16.5 12,16.5C13.88,16.5 16.5,17.38 16.93,18.28C15.57,19.36 13.86,20 12,20C10.14,20 8.43,19.36 7.07,18.28M18.36,16.83C16.93,15.09 13.46,14.5 12,14.5C10.54,14.5 7.07,15.09 5.64,16.83C4.62,15.5 4,13.82 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,13.82 19.38,15.5 18.36,16.83M12,6C10.06,6 8.5,7.56 8.5,9.5C8.5,11.44 10.06,13 12,13C13.94,13 15.5,11.44 15.5,9.5C15.5,7.56 13.94,6 12,6M12,11A1.5,1.5 0 0,1 10.5,9.5A1.5,1.5 0 0,1 12,8A1.5,1.5 0 0,1 13.5,9.5A1.5,1.5 0 0,1 12,11Z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-600">Visit Website</p>
                                <p class="text-sm text-gray-600">View public website</p>
                            </div>
                        </div>
                    </a>

                    <div class="group p-4 border border-gray-200 rounded-xl hover:border-gray-300 transition-all duration-200 opacity-60">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-gray-400 to-gray-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-700">More Features</p>
                                <p class="text-sm text-gray-500">Coming soon...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- System Information --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-600 mb-4">System Information</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Laravel Version</span>
                        <span class="text-sm font-medium text-gray-600">{{ app()->version() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">PHP Version</span>
                        <span class="text-sm font-medium text-gray-600">{{ PHP_VERSION }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Environment</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ app()->environment() === 'production' ? 'green' : 'yellow' }}-100 text-{{ app()->environment() === 'production' ? 'green' : 'yellow' }}-800">
                            {{ ucfirst(app()->environment()) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Server Time</span>
                        <span class="text-sm font-medium text-gray-600">{{ now()->format('H:i:s') }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-primary to-secondary rounded-xl text-white p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Need Help?</h3>
                    <svg class="w-8 h-8 text-white/80" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11,18H13V16H11V18M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,6A4,4 0 0,0 8,10H10A2,2 0 0,1 12,8A2,2 0 0,1 14,10C14,12 11,11.75 11,15H13C13,12.75 16,12.5 16,10A4,4 0 0,0 12,6Z"/>
                    </svg>
                </div>
                <p class="text-white/90 text-sm mb-4">
                    Check out our documentation or contact support for assistance with your admin panel.
                </p>
                <div class="flex space-x-3">
                    <button class="bg-white/20 hover:bg-white/30 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                        Documentation
                    </button>
                    <button class="bg-white/20 hover:bg-white/30 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                        Support
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
