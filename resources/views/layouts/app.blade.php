<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	@hasSection('head')
		@yield('head')
	@else
		<title>{{ $title ?? config('app.name', 'Professional Organization') }}</title>
		<meta name="description" content="Professional legal organization providing expert legal services and representation.">
		<meta name="keywords" content="legal services, law firm, professional legal advice">
	@endif
	
	@vite(['resources/css/app.css','resources/js/app.js'])
	
	@stack('styles')
</head>
<body class="min-h-screen bg-gray-100 text-gray-900">
	@include('layouts.header')
	<main>
		@yield('content')
	</main>
	@include('layouts.footer')
	
	@stack('scripts')
</body>
</html>


