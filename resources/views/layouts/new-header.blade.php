<!-- Overlay Header with Scroll Effects -->
<div class="fixed top-0 left-0 w-full z-50 transition-all duration-300" id="main-header">
    <!-- Top Contact Bar -->
    <div class="header-top bg-transparent border-b border-white/20 py-1 sm:py-2 transition-all duration-300">
        <div class="max-w-8xl mx-auto px-2 sm:px-4 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Contact Info -->
                <div class="hidden md:flex items-center space-x-4 lg:space-x-6 text-xs sm:text-sm text-white/90 header-contact">
                    @if ($globalProfile && $globalProfile->phone1)
                        <div class="flex items-center space-x-1 sm:space-x-2">
                            <i class="fas fa-phone text-white/90 text-xs"></i>
                            <a href="tel:{{ $globalProfile->phone1 }}" class="hover:text-white transition-colors">
                                {{ $globalProfile->phone1 }}
                            </a>
                        </div>
                    @endif
                    @if ($globalProfile && $globalProfile->email)
                        <div class="hidden lg:flex items-center space-x-1 sm:space-x-2">
                            <i class="fas fa-envelope text-white/90 text-xs"></i>
                            <a href="mailto:{{ $globalProfile->email }}" class="hover:text-white transition-colors">
                                {{ $globalProfile->email }}
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Language Selector & Social Links -->
                <div class="flex items-center space-x-2 sm:space-x-4 ml-auto">
                    <!-- Language Buttons -->
                    <div class="hidden sm:flex items-center space-x-1 header-languages">
                        <a href="#" class="px-1 sm:px-2 py-1 text-xs font-medium text-white/80 hover:text-white transition-colors">FR</a>
                        <span class="text-white/60 text-xs">|</span>
                        <a href="#" class="px-1 sm:px-2 py-1 text-xs font-medium text-white/80 hover:text-white transition-colors">中文</a>
                        <span class="text-white/60 text-xs">|</span>
                        <a href="#" class="px-1 sm:px-2 py-1 text-xs font-medium text-white/80 hover:text-white transition-colors">ES</a>
                    </div>

                    <!-- Social Links -->
                    <div class="flex items-center space-x-1 sm:space-x-2 header-social">
                        @if ($globalProfile && $globalProfile->whatsapp)
                            <a href="{{ $globalProfile->whatsapp }}" class="w-6 h-6 flex items-center justify-center text-green-400 hover:text-green-300 transition-colors">
                                <i class="fab fa-whatsapp text-sm"></i>
                                <span class="sr-only">WhatsApp</span>
                            </a>
                        @endif
                        @if ($globalProfile && $globalProfile->viber)
                            <a href="{{ $globalProfile->viber }}" class="w-6 h-6 flex items-center justify-center text-purple-400 hover:text-purple-300 transition-colors">
                                <i class="fab fa-viber text-sm"></i>
                                <span class="sr-only">Viber</span>
                            </a>
                        @endif
                        @if ($globalProfile && $globalProfile->wechat_link)
                            <a href="{{ $globalProfile->wechat_link }}" class="w-6 h-6 flex items-center justify-center text-green-400 hover:text-green-300 transition-colors">
                                <i class="fab fa-weixin text-sm"></i>
                                <span class="sr-only">WeChat</span>
                            </a>
                        @endif
                        @if ($globalProfile && $globalProfile->facebook_link)
                            <a href="{{ $globalProfile->facebook_link }}" class="w-6 h-6 flex items-center justify-center text-blue-400 hover:text-blue-300 transition-colors">
                                <i class="fab fa-facebook text-sm"></i>
                                <span class="sr-only">Facebook</span>
                            </a>
                        @endif
                        @if ($globalProfile && $globalProfile->linkedin_link)
                            <a href="{{ $globalProfile->linkedin_link }}" class="w-6 h-6 flex items-center justify-center text-blue-400 hover:text-blue-300 transition-colors">
                                <i class="fab fa-linkedin text-sm"></i>
                                <span class="sr-only">LinkedIn</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="header-main bg-transparent backdrop-blur-sm transition-all duration-300">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0">
                        @if ($globalProfile && $globalProfile->logo_url)
                            <img src="{{ $globalProfile->logo_url }}" alt="{{ config('app.name') }}" class="h-12 w-auto header-logo">
                        @else
                            <img src="assets/images/logo-light.png" alt="{{ config('app.name') }}" class="h-12 w-auto header-logo">
                        @endif
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8 header-nav">
                    <a href="{{ route('home') }}" class="text-white hover:text-white/80 font-medium transition-colors capitalize nav-link">Home</a>
                    <a href="/about/introduction" class="text-white hover:text-white/80 font-medium transition-colors capitalize nav-link">About</a>
                    <a href="{{ route('team.index') }}" class="text-white hover:text-white/80 font-medium transition-colors capitalize nav-link">Team</a>
                    
                    <!-- Practice Areas Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('practices.index') }}" class="text-white hover:text-white/80 font-medium transition-colors flex items-center capitalize nav-link">
                            Practice Areas
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </a>
                        @if ($navPracticeAreas && $navPracticeAreas->count() > 0)
                            <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="py-2">
                                    <a href="{{ route('practices.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">All Practice Areas</a>
                                    @foreach ($navPracticeAreas->take(8) as $practice)
                                        <a href="{{ route('practice.show', $practice->slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">{{ $practice->title }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Services Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('services.index') }}" class="text-white hover:text-white/80 font-medium transition-colors flex items-center capitalize nav-link">
                            Our Services
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </a>
                        @if ($navServices && $navServices->count() > 0)
                            <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="py-2">
                                    <a href="{{ route('services.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">All Services</a>
                                    @foreach ($navServices->take(8) as $service)
                                        <a href="{{ route('service.show', $service->slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">{{ $service->title }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- News & Publications Dropdown -->
                    <div class="relative group">
                        <a href="#" class="text-white hover:text-white/80 font-medium transition-colors flex items-center capitalize nav-link">
                           News & Publications
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </a>
                        <div class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="{{ route('posts.by-type', 'news') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">News</a>
                                <a href="{{ route('publications.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Publications</a>
                            </div>
                        </div>
                    </div>

                    <!-- Help Desk Dropdown -->
                    <div class="relative group">
                        <a href="#" class="text-white hover:text-white/80 font-medium transition-colors flex items-center nav-link">
                            Help Desk
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </a>
                        <div class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                @foreach ($navHelpDeskItems as $helpDeskItem)
                                    <a href="{{ $helpDeskItem['url'] }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">{{ $helpDeskItem['title'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <a href="/contact" class="text-white hover:text-white/80 font-medium transition-colors nav-link">Contact</a>
                    <a href="/calculator" class="text-white hover:text-white/80 font-medium transition-colors nav-link">Court Fees Calculator</a>
                </nav>

                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button type="button" class="mobile-nav__toggler inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white/80 hover:bg-white/10 transition-colors">
                        <span class="sr-only">Open main menu</span>
                        <div class="hamburger-icon w-6 h-6 flex flex-col justify-center items-center">
                            <span class="hamburger-line bg-current block h-0.5 w-6 transform transition-all ease-in-out duration-300"></span>
                            <span class="hamburger-line bg-current block h-0.5 w-6 transform transition-all ease-in-out duration-300 mt-1"></span>
                            <span class="hamburger-line bg-current block h-0.5 w-6 transform transition-all ease-in-out duration-300 mt-1"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </header>
</div>

<!-- Mobile Navigation Menu -->
<div class="mobile-nav fixed inset-0 z-40 transform translate-x-full transition-transform duration-300 ease-in-out lg:hidden" style="top: 100px;">
    <div class="flex h-full">
        <!-- Overlay -->
        <div class="mobile-nav__overlay fixed inset-0 bg-black/50 opacity-0 transition-opacity duration-300"></div>
        
        <!-- Menu Panel -->
        <div class="mobile-nav__panel relative ml-auto flex h-full w-full max-w-sm flex-col bg-white shadow-xl">
            
            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-4">
                <a href="{{ route('home') }}" class="block text-gray-800 hover:text-primary font-medium transition-colors capitalize">Home</a>
                <a href="/about/introduction" class="block text-gray-800 hover:text-primary font-medium transition-colors capitalize">About</a>
                <a href="{{ route('team.index') }}" class="block text-gray-800 hover:text-primary font-medium transition-colors capitalize">Team</a>
                <a href="{{ route('practices.index') }}" class="block text-gray-800 hover:text-primary font-medium transition-colors capitalize">Practice Areas</a>
                <a href="{{ route('services.index') }}" class="block text-gray-800 hover:text-primary font-medium transition-colors capitalize">Our Services</a>
                <a href="{{ route('posts.by-type', 'news') }}" class="block text-gray-800 hover:text-primary font-medium transition-colors">News</a>
                <a href="{{ route('publications.index') }}" class="block text-gray-800 hover:text-primary font-medium transition-colors">Publications</a>
                <a href="/contact" class="block text-gray-800 hover:text-primary font-medium transition-colors">Contact</a>
                <a href="/calculator" class="block text-gray-800 hover:text-primary font-medium transition-colors">Court Fees Calculator</a>
            </nav>
        </div>
    </div>
</div>

<style>
/* Header Scroll Effects */
#main-header.scrolled {
    background-color: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
}

#main-header.scrolled .header-top {
    background-color: rgba(249, 250, 251, 0.9);
    border-bottom-color: rgba(209, 213, 219, 0.3);
}

#main-header.scrolled .header-contact,
#main-header.scrolled .header-languages {
    color: rgb(75, 85, 99);
}

#main-header.scrolled .header-contact a,
#main-header.scrolled .header-languages a {
    color: rgb(107, 114, 128);
}

#main-header.scrolled .header-contact a:hover,
#main-header.scrolled .header-languages a:hover {
    color: rgb(59, 130, 246);
}

#main-header.scrolled .header-contact i {
    color: rgb(59, 130, 246);
}

#main-header.scrolled .header-social a {
    color: inherit;
}

#main-header.scrolled .nav-link {
    color: rgb(75, 85, 99) !important;
}

#main-header.scrolled .nav-link:hover {
    color: rgb(59, 130, 246) !important;
}

#main-header.scrolled .mobile-nav__toggler {
    color: rgb(75, 85, 99);
}

#main-header.scrolled .mobile-nav__toggler:hover {
    color: rgb(59, 130, 246);
    background-color: rgba(59, 130, 246, 0.1);
}

/* Mobile Navigation */
.mobile-nav.active {
    transform: translateX(0);
}

.mobile-nav.active .mobile-nav__overlay {
    opacity: 1;
}

/* Smooth transitions */
.nav-link {
    transition: color 0.3s ease;
}

/* Logo transition */
.header-logo {
    transition: all 0.3s ease;
}

/* Backdrop blur support */
@supports (backdrop-filter: blur(10px)) {
    #main-header.scrolled {
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
    }
}

@supports not (backdrop-filter: blur(10px)) {
    #main-header.scrolled {
        background-color: rgba(255, 255, 255, 0.95);
    }
}

/* Additional responsive improvements */
@media (max-width: 640px) {
    .header-top {
        min-height: 2rem;
    }
    
    .header-social a {
        width: 1.25rem;
        height: 1.25rem;
    }
    
    .header-social a i {
        font-size: 0.75rem;
    }
}

@media (max-width: 480px) {
    .header-social {
        max-width: 8rem;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    
    .header-social::-webkit-scrollbar {
        display: none;
    }
}

/* Prevent text overflow in contact info */
.header-contact a {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 10rem;
}

@media (min-width: 1024px) {
    .header-contact a {
        max-width: none;
    }
}

/* Hamburger Menu Animation */
.mobile-nav__toggler.active .hamburger-line:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
}

.mobile-nav__toggler.active .hamburger-line:nth-child(2) {
    opacity: 0;
    transform: translateX(20px);
}

.mobile-nav__toggler.active .hamburger-line:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -6px);
}

/* Adjust mobile navigation positioning */
.mobile-nav {
    height: calc(100vh - 80px);
    top: 80px;
}

.mobile-nav__overlay {
    top: 80px;
    height: calc(100vh - 80px);
}
</style>

<script>
// Header scroll effects and mobile navigation
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('main-header');
    const mobileToggler = document.querySelector('.mobile-nav__toggler');
    const mobileNav = document.querySelector('.mobile-nav');
    const mobileNavClose = document.querySelector('.mobile-nav__close');
    const mobileNavOverlay = document.querySelector('.mobile-nav__overlay');
    
    // Header scroll effect
    function handleScroll() {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
    
    // Throttled scroll handler for better performance
    let ticking = false;
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(() => {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', requestTick);
    
    // Mobile navigation
    function openMobileNav() {
        mobileNav.classList.add('active');
        mobileToggler.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMobileNav() {
        mobileNav.classList.remove('active');
        mobileToggler.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    if (mobileToggler) {
        mobileToggler.addEventListener('click', function() {
            if (mobileNav.classList.contains('active')) {
                closeMobileNav();
            } else {
                openMobileNav();
            }
        });
    }
    
    if (mobileNavClose) {
        mobileNavClose.addEventListener('click', closeMobileNav);
    }
    
    if (mobileNavOverlay) {
        mobileNavOverlay.addEventListener('click', closeMobileNav);
    }
    
    // Close mobile nav on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
            closeMobileNav();
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024 && mobileNav.classList.contains('active')) {
            closeMobileNav();
        }
    });
    
    // Initialize scroll state
    handleScroll();
});
</script>
