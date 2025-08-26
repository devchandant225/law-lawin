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
	  <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 1; }
            100% { transform: scale(2.5); opacity: 0; }
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }
        
        .slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }
        
        .contact-item {
            opacity: 0;
            transform: translateX(100%);
        }
        
        .contact-item.show {
            animation: slideIn 0.5s ease-out forwards;
        }
        
        .contact-item:nth-child(1) { animation-delay: 0.1s; }
        .contact-item:nth-child(2) { animation-delay: 0.2s; }
        .contact-item:nth-child(3) { animation-delay: 0.3s; }
    </style>
	@stack('styles')
</head>
<body class="min-h-screen bg-[#e7e8f0] text-gray-900">
	@include('layouts.header')
	<main>
		@yield('content')
	</main>
	{{-- Add to your layout head section --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

{{-- Floating Contact Section --}}
<div class="fixed bottom-6 right-6 z-50" id="floatingContact">
    {{-- Main Toggle Button --}}
    <div class="relative mb-4" id="mainButton">
        
        <button onclick="toggleContactMenu()" class="relative w-16 h-16 bg-primary hover:bg-blue-600 text-white rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-primary focus:ring-opacity-50">
            <i class="fas fa-comments text-xl" id="toggleIcon"></i>
        </button>
    </div>

    {{-- Contact Options Menu --}}
    <div class="space-y-3" id="contactMenu" style="display: none;">
        {{-- WhatsApp --}}
        <div class="contact-item">
            <a href="https://wa.me/{{ config('app.whatsapp_number') }}" target="_blank" class="flex items-center justify-center w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 ml-auto group relative">
                <i class="fab fa-whatsapp text-xl"></i>
                <div class="absolute right-full mr-3 px-3 py-2 bg-gray-800 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 whitespace-nowrap">
                    WhatsApp
                    <div class="absolute top-1/2 left-full w-0 h-0 border-l-4 border-l-gray-800 border-y-4 border-y-transparent transform -translate-y-1/2"></div>
                </div>
            </a>
        </div>

        {{-- Viber --}}
        <div class="contact-item">
            <a href="viber://chat?number={{ config('app.viber_number') }}" target="_blank" class="flex items-center justify-center w-14 h-14 bg-purple-500 hover:bg-purple-600 text-white rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 ml-auto group relative">
                <i class="fab fa-viber text-xl"></i>
                <div class="absolute right-full mr-3 px-3 py-2 bg-gray-800 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 whitespace-nowrap">
                    Viber
                    <div class="absolute top-1/2 left-full w-0 h-0 border-l-4 border-l-gray-800 border-y-4 border-y-transparent transform -translate-y-1/2"></div>
                </div>
            </a>
        </div>

        {{-- Phone Call --}}
        <div class="contact-item">
            <a href="tel:{{ config('app.phone_number') }}" class="flex items-center justify-center w-14 h-14 bg-secondary hover:bg-emerald-600 text-white rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 ml-auto group relative">
                <i class="fas fa-phone text-xl"></i>
                <div class="absolute right-full mr-3 px-3 py-2 bg-gray-800 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 whitespace-nowrap">
                    Call Now
                    <div class="absolute top-1/2 left-full w-0 h-0 border-l-4 border-l-gray-800 border-y-4 border-y-transparent transform -translate-y-1/2"></div>
                </div>
            </a>
        </div>
    </div>
</div>
	@include('layouts.footer')
	 <script>
        let isMenuOpen = false;

        function toggleContactMenu() {
            const menu = document.getElementById('contactMenu');
            const icon = document.getElementById('toggleIcon');
            const contactItems = document.querySelectorAll('.contact-item');

            if (!isMenuOpen) {
                // Show menu
                menu.style.display = 'block';
                icon.className = 'fas fa-times text-xl transform rotate-180 transition-transform duration-300';
                
                // Animate items in
                setTimeout(() => {
                    contactItems.forEach(item => {
                        item.classList.add('show');
                    });
                }, 50);
                
                isMenuOpen = true;
            } else {
                // Hide menu
                icon.className = 'fas fa-comments text-xl transform rotate-0 transition-transform duration-300';
                
                // Animate items out
                contactItems.forEach(item => {
                    item.classList.remove('show');
                });
                
                setTimeout(() => {
                    menu.style.display = 'none';
                }, 300);
                
                isMenuOpen = false;
            }
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const floatingContact = document.getElementById('floatingContact');
            
            if (!floatingContact.contains(event.target) && isMenuOpen) {
                toggleContactMenu();
            }
        });

        // Add some scroll-based animation
        window.addEventListener('scroll', function() {
            const floatingContact = document.getElementById('floatingContact');
            const scrollY = window.scrollY;
            
            if (scrollY > 100) {
                floatingContact.style.transform = 'translateY(0)';
                floatingContact.style.opacity = '1';
            }
        });
    </script>
	@stack('scripts')
</body>
</html>


