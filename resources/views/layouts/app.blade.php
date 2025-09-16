<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />

    {{-- Dynamic Meta Tags Component --}}
    <x-meta-tags :post="$post ?? null" />

    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

    <!-- FontAwesome 5 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    @hasSection('head')
        @yield('head')
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
    <style>
        ul {
            list-style: disc !important;
        }
    </style>
    @stack('styles')
</head>

<body class="custom-cursor">
    <div class="page-wrapper relative">
        @include('layouts.new-header')

        @yield('content')

        @include('layouts.footer')
    </div>






    <!-- Livewire Scripts -->
    @livewireScripts

    @stack('scripts')

    {{-- Floating Contact Component --}}
    @include('layouts.partials.floating-contact')

    <!-- Livewire Scripts -->
    @livewireScripts

    @stack('scripts')

    {{-- Floating Contact Component --}}
    @include('layouts.partials.floating-contact')
</body>

</html>
