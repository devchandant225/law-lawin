<!-- Top Contact Bar - Scrollable -->
<div class="header-top bg-white border-b border-gray-200 py-1 transition-all duration-300" id="top-header">
    <div class="max-w-8xl mx-auto px-2 sm:px-4 lg:px-8">
        <!-- Desktop Layout -->
        <div class="hidden md:flex justify-between items-center">
            <!-- Contact Info -->
            <div class="flex items-center space-x-4 lg:space-x-6 text-xs sm:text-sm text-gray-600 header-contact">
                @if ($globalProfile && $globalProfile->phone1)
                    <div class="flex items-center space-x-1 sm:space-x-2">
                        <i class="fas fa-phone text-gray-500 text-xs"></i>
                        <a href="tel:{{ $globalProfile->phone1 }}" class="hover:text-gray-800 transition-colors">
                            {{ $globalProfile->phone1 }}
                        </a>
                    </div>
                @endif
                @if ($globalProfile && $globalProfile->email)
                    <div class="flex items-center space-x-1 sm:space-x-2">
                        <i class="fas fa-envelope text-gray-500 text-xs"></i>
                        <a href="mailto:{{ $globalProfile->email }}" class="hover:text-gray-800 transition-colors">
                            {{ $globalProfile->email }}
                        </a>
                    </div>
                @endif
            </div>

            <!-- Social Links -->
            <div class="flex items-center space-x-1 sm:space-x-2 header-social">
                @if ($globalProfile && $globalProfile->whatsapp)
                    <a href="{{ $globalProfile->whatsapp }}"
                        class="w-6 h-6 flex items-center justify-center text-green-600 hover:text-green-700 hover:bg-green-50 rounded-full transition-all duration-200">
                        <i class="fab fa-whatsapp text-sm"></i>
                        <span class="sr-only">WhatsApp</span>
                    </a>
                @endif
                @if ($globalProfile && $globalProfile->viber)
                    <a href="{{ $globalProfile->viber }}"
                        class="w-6 h-6 flex items-center justify-center text-purple-600 hover:text-purple-700 hover:bg-purple-50 rounded-full transition-all duration-200">
                        <i class="fab fa-viber text-sm"></i>
                        <span class="sr-only">Viber</span>
                    </a>
                @endif
                @if ($globalProfile && $globalProfile->wechat_link)
                    <a href="{{ $globalProfile->wechat_link }}"
                        class="w-6 h-6 flex items-center justify-center text-green-600 hover:text-green-700 hover:bg-green-50 rounded-full transition-all duration-200">
                        <i class="fab fa-weixin text-sm"></i>
                        <span class="sr-only">WeChat</span>
                    </a>
                @endif
                @if ($globalProfile && $globalProfile->facebook_link)
                    <a href="{{ $globalProfile->facebook_link }}"
                        class="w-6 h-6 flex items-center justify-center text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-full transition-all duration-200">
                        <i class="fab fa-facebook text-sm"></i>
                        <span class="sr-only">Facebook</span>
                    </a>
                @endif
                @if ($globalProfile && $globalProfile->linkedin_link)
                    <a href="{{ $globalProfile->linkedin_link }}"
                        class="w-6 h-6 flex items-center justify-center text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-full transition-all duration-200">
                        <i class="fab fa-linkedin text-sm"></i>
                        <span class="sr-only">LinkedIn</span>
                    </a>
                @endif
                <a href="/calculator"
                    class="w-6 h-6 flex items-center justify-center text-gray-600 hover:text-gray-700 hover:bg-gray-50 rounded-full transition-all duration-200">
                    <i class="fa fa-calculator text-sm"></i>
                    <span class="sr-only">Calculator</span>
                </a>
            </div>
        </div>

        <!-- Mobile Layout -->
        <div class="md:hidden">
            <!-- Top Row: Contact Info -->
            <div class="flex justify-center items-center space-x-4 py-1 border-b border-gray-100">
                @if ($globalProfile && $globalProfile->phone1)
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-phone text-gray-500 text-xs"></i>
                        <a href="tel:{{ $globalProfile->phone1 }}"
                            class="text-xs text-gray-600 hover:text-gray-800 transition-colors">
                            {{ $globalProfile->phone1 }}
                        </a>
                    </div>
                @endif
                @if ($globalProfile && $globalProfile->email)
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-envelope text-gray-500 text-xs"></i>
                        <a href="mailto:{{ $globalProfile->email }}"
                            class="text-xs text-gray-600 hover:text-gray-800 transition-colors truncate max-w-32">
                            {{ $globalProfile->email }}
                        </a>
                    </div>
                @endif
            </div>

            <!-- Bottom Row: Social Links -->
            <div class="flex justify-center items-center space-x-2 py-1">
                @if ($globalProfile && $globalProfile->whatsapp)
                    <a href="{{ $globalProfile->whatsapp }}"
                        class="w-6 h-6 flex items-center justify-center text-green-600 hover:text-green-700 hover:bg-green-50 rounded-full transition-all duration-200">
                        <i class="fab fa-whatsapp text-sm"></i>
                        <span class="sr-only">WhatsApp</span>
                    </a>
                @endif
                @if ($globalProfile && $globalProfile->viber)
                    <a href="{{ $globalProfile->viber }}"
                        class="w-6 h-6 flex items-center justify-center text-purple-600 hover:text-purple-700 hover:bg-purple-50 rounded-full transition-all duration-200">
                        <i class="fab fa-viber text-sm"></i>
                        <span class="sr-only">Viber</span>
                    </a>
                @endif
                @if ($globalProfile && $globalProfile->wechat_link)
                    <a href="{{ $globalProfile->wechat_link }}"
                        class="w-6 h-6 flex items-center justify-center text-green-600 hover:text-green-700 hover:bg-green-50 rounded-full transition-all duration-200">
                        <i class="fab fa-weixin text-sm"></i>
                        <span class="sr-only">WeChat</span>
                    </a>
                @endif
                @if ($globalProfile && $globalProfile->facebook_link)
                    <a href="{{ $globalProfile->facebook_link }}"
                        class="w-6 h-6 flex items-center justify-center text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-full transition-all duration-200">
                        <i class="fab fa-facebook text-sm"></i>
                        <span class="sr-only">Facebook</span>
                    </a>
                @endif
                @if ($globalProfile && $globalProfile->linkedin_link)
                    <a href="{{ $globalProfile->linkedin_link }}"
                        class="w-6 h-6 flex items-center justify-center text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-full transition-all duration-200">
                        <i class="fab fa-linkedin text-sm"></i>
                        <span class="sr-only">LinkedIn</span>
                    </a>
                @endif
                <a href="/calculator"
                    class="w-6 h-6 flex items-center justify-center text-gray-600 hover:text-gray-700 hover:bg-gray-50 rounded-full transition-all duration-200">
                    <i class="fa fa-calculator text-sm"></i>
                    <span class="sr-only">Calculator</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Header - Sticky -->
<div class="sticky top-0 left-0 w-full z-50 transition-all duration-300" id="main-header">
    <header class="header-main transition-all duration-300">
        <div class="lg:max-w-8xl w-full mx-auto px-2 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0">
                        @if ($globalProfile && $globalProfile->logo_url)
                            <img src="{{ $globalProfile->logo_url }}" alt="{{ config('app.name') }}"
                                class="w-[10rem] h-[4rem] lg:h-16 lg:w-auto header-logo">
                        @else
                            <img src="assets/images/logo-light.png" alt="{{ config('app.name') }}"
                                class="h-12 w-auto header-logo">
                        @endif
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8 header-nav">
                    <a href="{{ route('home') }}"
                        class="text-nav font-medium transition-colors capitalize nav-link">Home</a>
                    <a href="{{ route('about') }}"
                        class="text-nav hover:text-white/80 font-medium transition-colors capitalize nav-link">About</a>

                    <!-- Services Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('services.index') }}"
                            class="text-nav font-medium transition-colors flex items-center capitalize nav-link group/link">
                            Our Services
                            <i
                                class="fas fa-chevron-down ml-1 text-xs transform group-hover:rotate-180 transition-transform duration-300"></i>
                        </a>
                        @if ($navServices && $navServices->count() > 0)
                            <div
                                class="absolute top-full left-0 mt-2 w-72 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-out z-50">
                                <div class="py-3">
                                    <div class="px-4 pb-2 mb-2 border-b border-gray-100">
                                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Our
                                            Services</span>
                                    </div>
                                    <a href="{{ route('services.index') }}"
                                        class="group/item flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary/5 hover:to-primary/10 hover:text-primary transition-all duration-200 rounded-lg mx-2">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-primary/10 group-hover/item:bg-primary/20 flex items-center justify-center mr-3 transition-colors">
                                            <i class="fas fa-briefcase text-primary text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium">All Services</div>
                                            <div class="text-xs text-gray-500 group-hover/item:text-primary/70">
                                                Complete service portfolio</div>
                                        </div>
                                    </a>
                                    <div class="h-px bg-gray-100 my-2 mx-4"></div>
                                    @foreach ($navServices->take(10) as $service)
                                        <a href="{{ route('service.show', $service->slug) }}"
                                            class="group/item flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary/5 hover:to-primary/10 hover:text-primary transition-all duration-200 rounded-lg mx-2">
                                            <div
                                                class="w-6 h-6 rounded-md bg-gray-100 group-hover/item:bg-primary/10 flex items-center justify-center mr-3 transition-colors flex-shrink-0">
                                                <i
                                                    class="fas fa-cog text-gray-400 group-hover/item:text-primary text-xs transition-colors"></i>
                                            </div>
                                            <span class="font-medium">{{ $service->title }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Practice Areas Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('practice.index') }}"
                            class="text-nav font-medium transition-colors flex items-center capitalize nav-link group/link">
                            Practice Areas
                            <i
                                class="fas fa-chevron-down ml-1 text-xs transform group-hover:rotate-180 transition-transform duration-300"></i>
                        </a>
                        @if ($navPracticeAreas && $navPracticeAreas->count() > 0)
                            <div
                                class="absolute top-full left-0 mt-2 w-72 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-out z-50">
                                <div class="py-3">
                                    <div class="px-4 pb-2 mb-2 border-b border-gray-100">
                                        <span
                                            class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Practice
                                            Areas</span>
                                    </div>
                                    <a href="{{ route('practice.index') }}"
                                        class="group/item flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary/5 hover:to-primary/10 hover:text-primary transition-all duration-200 rounded-lg mx-2">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-primary/10 group-hover/item:bg-primary/20 flex items-center justify-center mr-3 transition-colors">
                                            <i class="fas fa-th-large text-primary text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium">All Practice Areas</div>
                                            <div class="text-xs text-gray-500 group-hover/item:text-primary/70">View
                                                complete list</div>
                                        </div>
                                    </a>
                                    <div class="h-px bg-gray-100 my-2 mx-4"></div>
                                    @foreach ($navPracticeAreas->take(10) as $practice)
                                        <a href="{{ route('practice.show', $practice->slug) }}"
                                            class="group/item flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary/5 hover:to-primary/10 hover:text-primary transition-all duration-200 rounded-lg mx-2">
                                            <div
                                                class="w-6 h-6 rounded-md bg-gray-100 group-hover/item:bg-primary/10 flex items-center justify-center mr-3 transition-colors flex-shrink-0">
                                                <i
                                                    class="fas fa-balance-scale text-gray-400 group-hover/item:text-primary text-xs transition-colors"></i>
                                            </div>
                                            <span class="font-medium">{{ $practice->title }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>


                    <!-- Help Desk Dropdown -->

                    <!-- News & Publications Dropdown -->
                    <div class="relative group">
                        <a href="#"
                            class="text-nav font-medium transition-colors flex items-center capitalize nav-link group/link">
                            News & Publications
                            <i
                                class="fas fa-chevron-down ml-1 text-xs transform group-hover:rotate-180 transition-transform duration-300"></i>
                        </a>
                        <div
                            class="absolute top-full left-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-out z-50">
                            <div class="py-3">
                                <div class="px-4 pb-2 mb-2 border-b border-gray-100">
                                    <span
                                        class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Resources</span>
                                </div>
                                <a href="{{ route('publications.index') }}"
                                    class="group/item flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary/5 hover:to-primary/10 hover:text-primary transition-all duration-200 rounded-lg mx-2">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-green-50 group-hover/item:bg-green-100 flex items-center justify-center mr-3 transition-colors">
                                        <i class="fas fa-book text-green-500 text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium">Publications</div>
                                        <div class="text-xs text-gray-500 group-hover/item:text-primary/70">Research &
                                            reports</div>
                                    </div>
                                </a>
                                <a href="{{ route('posts.by-type', 'news') }}"
                                    class="group/item flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary/5 hover:to-primary/10 hover:text-primary transition-all duration-200 rounded-lg mx-2">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-blue-50 group-hover/item:bg-blue-100 flex items-center justify-center mr-3 transition-colors">
                                        <i class="fas fa-newspaper text-blue-500 text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium">News</div>
                                        <div class="text-xs text-gray-500 group-hover/item:text-primary/70">Latest
                                            updates & insights</div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                    <a href="{{ route('team.index') }}"
                        class="text-nav hover:text-white/80 font-medium transition-colors capitalize nav-link">Team</a>
                    <div class="relative group">
                        <a href="{{ route('help-desk.index') }}"
                            class="text-nav font-medium transition-colors flex items-center capitalize nav-link group/link">
                            Help Desk
                            <i
                                class="fas fa-chevron-down ml-1 text-xs transform group-hover:rotate-180 transition-transform duration-300"></i>
                        </a>
                        <div
                            class="absolute top-full right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-out z-50">
                            <div class="py-3">
                                <div class="px-4 pb-2 mb-2 border-b border-gray-100">
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Legal
                                        Help Desk</span>
                                </div>

                                <div class="h-px bg-gray-100 my-2 mx-4"></div>
                                @if ($navHelpDeskItems && $navHelpDeskItems->count() > 0)
                                    @foreach ($navHelpDeskItems as $item)
                                        <a href="{{ route('help-desk.show', $item->slug) }}"
                                            class="group/item flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary/5 hover:to-primary/10 hover:text-primary transition-all duration-200 rounded-lg mx-2">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-blue-50 group-hover/item:bg-blue-100 flex items-center justify-center mr-3 transition-colors overflow-hidden">
                                                @if ($item->icon)
                                                    <img src="{{ $item->icon_url }}" alt="{{ $item->title }}" class="w-full h-full object-contain p-1">
                                                @else
                                                    <i class="fas fa-info-circle text-blue-500 text-xs"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-medium">{{ $item->title }}</div>
                                                <div class="text-xs text-gray-500 group-hover/item:text-primary/70">
                                                    {{ Str::limit($item->excerpt, 40) }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="px-4 py-2 text-sm text-gray-500 italic">No items available</div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <a href="/contact" class="text-nav font-medium transition-colors nav-link">Contact</a>

                </nav>

                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button type="button"
                        class="mobile-nav__toggler inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white/80 hover:bg-white/10 transition-colors focus:outline-none">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fas fa-bars text-2xl menu-icon-open transition-transform duration-300"></i>
                        <i class="fas fa-times text-2xl menu-icon-close hidden transition-transform duration-300"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>
</div>

<!-- Mobile Navigation Menu -->
<div class="mobile-nav fixed inset-0 z-[999] transform translate-x-full transition-transform duration-300 ease-in-out lg:hidden">
    <!-- Overlay -->
    <div class="mobile-nav__overlay fixed inset-0 bg-black/60 opacity-0 transition-opacity duration-300 backdrop-blur-sm"></div>

    <!-- Menu Panel -->
    <div class="mobile-nav__panel absolute right-0 top-0 h-full w-[85%] max-w-sm bg-white shadow-2xl flex flex-col">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between p-5 border-b border-gray-100">
            <span class="text-xl font-bold text-gray-800">Menu</span>
            <button type="button" class="mobile-nav__close p-2 -mr-2 text-gray-400 hover:text-primary transition-colors focus:outline-none">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-2 overflow-y-auto custom-scrollbar">
            <div class="space-y-1">
                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary/5 hover:text-primary rounded-lg transition-all group">
                    <div class="w-8 flex justify-center"><i class="fas fa-home text-gray-400 group-hover:text-primary transition-colors"></i></div>
                    <span class="font-medium">Home</span>
                </a>
                
                <a href="{{ route('about') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary/5 hover:text-primary rounded-lg transition-all group">
                     <div class="w-8 flex justify-center"><i class="fas fa-info-circle text-gray-400 group-hover:text-primary transition-colors"></i></div>
                    <span class="font-medium">About</span>
                </a>

                <div class="border-t border-gray-100 my-2"></div>
                
                 <div class="px-4 py-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Services</div>
                 
                 <a href="{{ route('services.index') }}" class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-primary/5 hover:text-primary rounded-lg transition-all group">
                    <div class="w-8 flex justify-center"><i class="fas fa-briefcase text-gray-400 group-hover:text-primary transition-colors text-sm"></i></div>
                    <span class="font-medium">Our Services</span>
                </a>

                <a href="{{ route('practice.index') }}" class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-primary/5 hover:text-primary rounded-lg transition-all group">
                    <div class="w-8 flex justify-center"><i class="fas fa-balance-scale text-gray-400 group-hover:text-primary transition-colors text-sm"></i></div>
                    <span class="font-medium">Practice Areas</span>
                </a>

                <div class="border-t border-gray-100 my-2"></div>
                
                <div class="px-4 py-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Resources</div>

                <a href="{{ route('posts.by-type', 'news') }}" class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-primary/5 hover:text-primary rounded-lg transition-all group">
                    <div class="w-8 flex justify-center"><i class="fas fa-newspaper text-gray-400 group-hover:text-primary transition-colors text-sm"></i></div>
                    <span class="font-medium">News</span>
                </a>
                <a href="{{ route('publications.index') }}" class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-primary/5 hover:text-primary rounded-lg transition-all group">
                    <div class="w-8 flex justify-center"><i class="fas fa-book text-gray-400 group-hover:text-primary transition-colors text-sm"></i></div>
                    <span class="font-medium">Publications</span>
                </a>

                 <div class="border-t border-gray-100 my-2"></div>

                 <!-- Help Desk -->
                 <div class="space-y-1">
                    <button class="w-full flex items-center justify-between px-4 py-2.5 text-gray-700 hover:bg-primary/5 hover:text-primary rounded-lg transition-all group text-left focus:outline-none" onclick="document.getElementById('mobile-help-desk').classList.toggle('hidden'); this.querySelector('.chevron').classList.toggle('rotate-180');">
                        <div class="flex items-center">
                            <div class="w-8 flex justify-center"><i class="fas fa-headset text-gray-400 group-hover:text-primary transition-colors text-sm"></i></div>
                            <span class="font-medium">Help Desk</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-300 chevron"></i>
                    </button>
                    <div id="mobile-help-desk" class="hidden pl-10 pr-2 space-y-1 bg-gray-50/50 rounded-lg py-2 mx-2">
                        @if ($navHelpDeskItems && $navHelpDeskItems->count() > 0)
                            @foreach ($navHelpDeskItems as $item)
                                <a href="{{ route('help-desk.show', $item->slug) }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-primary transition-colors rounded hover:bg-white group">
                                    <div class="w-6 h-6 rounded bg-blue-50 group-hover:bg-blue-100 flex items-center justify-center mr-3 transition-colors overflow-hidden flex-shrink-0">
                                        @if ($item->icon)
                                            <img src="{{ $item->icon_url }}" alt="{{ $item->title }}" class="w-full h-full object-contain p-0.5">
                                        @else
                                            <i class="fas fa-info-circle text-blue-500 text-[10px]"></i>
                                        @endif
                                    </div>
                                    <span class="truncate">{{ $item->title }}</span>
                                </a>
                            @endforeach
                        @else
                             <div class="px-3 py-2 text-xs text-gray-400 italic">No items available</div>
                        @endif
                         <a href="{{ route('help-desk.index') }}" class="block px-3 py-2 text-sm font-medium text-primary hover:underline mt-1 ml-9">View All</a>
                    </div>
                </div>

                 <div class="border-t border-gray-100 my-2"></div>
                
                <a href="/contact" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary/5 hover:text-primary rounded-lg transition-all group">
                    <div class="w-8 flex justify-center"><i class="fas fa-envelope text-gray-400 group-hover:text-primary transition-colors text-sm"></i></div>
                    <span class="font-medium">Contact Us</span>
                </a>
                 <a href="{{ route('team.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary/5 hover:text-primary rounded-lg transition-all group">
                    <div class="w-8 flex justify-center"><i class="fas fa-users text-gray-400 group-hover:text-primary transition-colors text-sm"></i></div>
                    <span class="font-medium">Our Team</span>
                </a>
            </div>
        </nav>
        
        <!-- Bottom Panel -->
        <div class="p-5 border-t border-gray-100 bg-gray-50">
             <div class="flex justify-center space-x-6 mb-4">
                @if ($globalProfile && $globalProfile->facebook_link)
                    <a href="{{ $globalProfile->facebook_link }}" class="text-gray-400 hover:text-blue-600 transition-colors"><i class="fab fa-facebook text-xl"></i></a>
                @endif
                @if ($globalProfile && $globalProfile->linkedin_link)
                    <a href="{{ $globalProfile->linkedin_link }}" class="text-gray-400 hover:text-blue-700 transition-colors"><i class="fab fa-linkedin text-xl"></i></a>
                @endif
                @if ($globalProfile && $globalProfile->whatsapp)
                    <a href="{{ $globalProfile->whatsapp }}" class="text-gray-400 hover:text-green-600 transition-colors"><i class="fab fa-whatsapp text-xl"></i></a>
                @endif
             </div>
             <div class="text-center">
                  <a href="/calculator" class="inline-flex items-center justify-center w-full px-4 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors shadow-sm">
                      <i class="fas fa-calculator mr-2"></i> Cost Calculator
                  </a>
             </div>
        </div>
    </div>
</div>

<style>
    /* Top Header - Normal scrollable section */
    #top-header {
        position: relative;
        z-index: 40;
    }

    /* Main Header - Sticky section */
    #main-header {
        background-color: transparent;
        transition: all 0.3s ease;
    }

    /* Header Scroll Effects - When main header gets background */
    #main-header.scrolled {
        background-color: rgba(249, 250, 251, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    #main-header.scrolled .nav-link {
        color: rgb(75, 85, 99) !important;
    }

    #main-header.scrolled .nav-link:hover {
        color: #139fba !important;
    }

    #main-header.scrolled .mobile-nav__toggler {
        color: rgb(75, 85, 99);
    }

    #main-header.scrolled .mobile-nav__toggler:hover {
        color: #139fba;
        background-color: rgba(59, 130, 246, 0.1);
    }

    /* Ensure main header has background when top header is scrolled away */
    #main-header.scrolled-past-top {
        background-color: rgba(249, 250, 251, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    #main-header.scrolled-past-top .nav-link {
        color: rgb(75, 85, 99) !important;
    }

    #main-header.scrolled-past-top .nav-link:hover {
        color: #139fba !important;
    }

    #main-header.scrolled-past-top .mobile-nav__toggler {
        color: rgb(75, 85, 99);
    }

    #main-header.scrolled-past-top .mobile-nav__toggler:hover {
        color: #139fba;
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
            background-color: #fff;
        }
    }

    @supports not (backdrop-filter: blur(10px)) {
        #main-header.scrolled {
            background-color: #fff;
        }
    }

    /* Header Top Styling */
    .header-top {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    /* Social links hover effects */
    .header-social a {
        transition: all 0.2s ease;
    }

    .header-social a:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Additional responsive improvements */
    @media (max-width: 768px) {
        .header-top {
            min-height: auto;
            padding: 0.5rem 0;
        }

        .header-social a {
            width: 1.5rem;
            height: 1.5rem;
        }

        .header-social a i {
            font-size: 0.875rem;
        }
    }

    @media (max-width: 640px) {
        .header-top {
            min-height: auto;
            padding: 0.25rem 0;
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
        .header-top {
            padding: 0.25rem 0;
        }

        .header-social {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.25rem;
        }

        .header-social a {
            width: 1.25rem;
            height: 1.25rem;
        }

        /* Mobile contact info */
        .max-w-32 {
            max-width: 8rem;
        }
    }

    /* Prevent text overflow in contact info */
    .header-contact a {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 10rem;
        font-weight: 500;
    }

    @media (min-width: 1024px) {
        .header-contact a {
            max-width: none;
        }
    }

    /* Mobile responsive contact layout */
    @media (max-width: 767px) {
        .header-top .border-b {
            border-color: #e5e7eb;
        }

        .header-contact a {
            font-size: 0.75rem;
            max-width: 7rem;
        }
    }

    /* Mobile Menu Toggle Icon */
    .mobile-nav__toggler.active .menu-icon-open {
        display: none;
    }
    
    .mobile-nav__toggler.active .menu-icon-close {
        display: inline-block;
    }
    
    /* Ensure close icon is visible against white menu background if header is transparent */
    .mobile-nav__toggler.active {
        color: #374151 !important; /* gray-700 */
        z-index: 1000; 
        position: relative;
    }

    /* Custom Scrollbar for Mobile Menu */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1; 
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #d1d5db; 
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #9ca3af; 
    }
</style>

<script>
    // Header scroll effects and mobile navigation
    document.addEventListener('DOMContentLoaded', function() {
        const topHeader = document.getElementById('top-header');
        const mainHeader = document.getElementById('main-header');
        const mobileToggler = document.querySelector('.mobile-nav__toggler');
        const mobileNav = document.querySelector('.mobile-nav');
        const mobileNavClose = document.querySelector('.mobile-nav__close');
        const mobileNavOverlay = document.querySelector('.mobile-nav__overlay');

        // Header scroll effect
        function handleScroll() {
            const topHeaderHeight = topHeader ? topHeader.offsetHeight : 0;
            const scrollY = window.scrollY;

            // Add background to main header when top header starts scrolling away
            if (scrollY > topHeaderHeight / 2) {
                mainHeader.classList.add('scrolled');
            } else {
                mainHeader.classList.remove('scrolled');
            }

            // Additional class when completely past top header
            if (scrollY > topHeaderHeight) {
                mainHeader.classList.add('scrolled-past-top');
            } else {
                mainHeader.classList.remove('scrolled-past-top');
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
