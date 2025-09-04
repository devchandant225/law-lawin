        <!-- Top Contact Bar -->
        <div class="bg-gray-50 border-b border-gray-200 py-2">
            <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <!-- Contact Info -->
                    <div class="flex items-center space-x-6 text-sm text-gray-600">
                        @if ($globalProfile && $globalProfile->phone1)
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-phone text-primary"></i>
                                <a href="tel:{{ $globalProfile->phone1 }}" class="hover:text-primary transition-colors">
                                    {{ $globalProfile->phone1 }}
                                </a>
                            </div>
                        @endif
                        @if ($globalProfile && $globalProfile->email)
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-envelope text-primary"></i>
                                <a href="mailto:{{ $globalProfile->email }}" class="hover:text-primary transition-colors">
                                    {{ $globalProfile->email }}
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Language Selector & Social Links -->
                    <div class="flex items-center space-x-4">
                        <!-- Language Buttons -->
                        <div class="flex items-center space-x-1">
                            <a href="#" class="px-2 py-1 text-xs font-medium text-gray-600 hover:text-primary transition-colors">French</a>
                            <span class="text-gray-400">|</span>
                            <a href="#" class="px-2 py-1 text-xs font-medium text-gray-600 hover:text-primary transition-colors">中国人</a>
                            <span class="text-gray-400">|</span>
                            <a href="#" class="px-2 py-1 text-xs font-medium text-gray-600 hover:text-primary transition-colors">Español</a>
                        </div>

                        <!-- Social Links -->
                        <div class="flex items-center space-x-2">
                            @if ($globalProfile && $globalProfile->whatsapp)
                                <a href="{{ $globalProfile->whatsapp }}" class="w-6 h-6 flex items-center justify-center text-green-600 hover:text-green-700 transition-colors">
                                    <i class="fab fa-whatsapp text-sm"></i>
                                    <span class="sr-only">WhatsApp</span>
                                </a>
                            @endif
                            @if ($globalProfile && $globalProfile->viber)
                                <a href="{{ $globalProfile->viber }}" class="w-6 h-6 flex items-center justify-center text-purple-600 hover:text-purple-700 transition-colors">
                                    <i class="fab fa-viber text-sm"></i>
                                    <span class="sr-only">Viber</span>
                                </a>
                            @endif
                            @if ($globalProfile && $globalProfile->wechat_link)
                                <a href="{{ $globalProfile->wechat_link }}" class="w-6 h-6 flex items-center justify-center text-green-500 hover:text-green-600 transition-colors">
                                    <i class="fab fa-weixin text-sm"></i>
                                    <span class="sr-only">WeChat</span>
                                </a>
                            @endif
                            @if ($globalProfile && $globalProfile->facebook_link)
                                <a href="{{ $globalProfile->facebook_link }}" class="w-6 h-6 flex items-center justify-center text-blue-600 hover:text-blue-700 transition-colors">
                                    <i class="fab fa-facebook text-sm"></i>
                                    <span class="sr-only">Facebook</span>
                                </a>
                            @endif
                            @if ($globalProfile && $globalProfile->linkedin_link)
                                <a href="{{ $globalProfile->linkedin_link }}" class="w-6 h-6 flex items-center justify-center text-blue-700 hover:text-blue-800 transition-colors">
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
        <header class="bg-white shadow-sm transition-all duration-300 z-50">
            <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex-shrink-0">
                            @if ($globalProfile && $globalProfile->logo_url)
                                <img src="{{ $globalProfile->logo_url }}" alt="{{ config('app.name') }}" class="h-12 w-auto">
                            @else
                                <img src="assets/images/logo-light.png" alt="{{ config('app.name') }}" class="h-12 w-auto">
                            @endif
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <nav class="hidden lg:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-700 capitalize hover:text-primary font-medium transition-colors">Home</a>
                        <a href="/about/introduction" class="text-gray-700 hover:text-primary font-medium transition-colors capitalize">About</a>
                        <a href="{{ route('team.index') }}" class="text-gray-700 hover:text-primary font-medium transition-colors capitalize">Team</a>
                        
                        <!-- Practice Areas Dropdown -->
                        <div class="relative group">
                            <a href="{{ route('practices.index') }}" class="text-gray-700 hover:text-primary font-medium transition-colors flex items-center capitalize">
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
                            <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-primary font-medium transition-colors flex items-center capitalize">
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
                            <a href="#" class="text-gray-700 hover:text-primary font-medium transition-colors flex items-center capitalize">
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
                            <a href="#" class="text-gray-700 hover:text-primary font-medium transition-colors flex items-center">
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

                        <a href="/contact" class="text-gray-700 hover:text-primary font-medium transition-colors">Contact</a>
                          <a href="/calculator" class="text-gray-700 hover:text-primary font-medium transition-colors">Court Fees Calculator</a>
                    </nav>

                    <!-- Mobile menu button -->
                    <div class="lg:hidden">
                        <button type="button" class="mobile-nav__toggler inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-primary hover:bg-gray-100 transition-colors">
                            <span class="sr-only">Open main menu</span>
                            <div class="w-6 h-6 flex flex-col justify-center items-center">
                                <span class="bg-current block h-0.5 w-6 transform transition ease-in-out duration-200"></span>
                                <span class="bg-current block h-0.5 w-6 transform transition ease-in-out duration-200 mt-1"></span>
                                <span class="bg-current block h-0.5 w-6 transform transition ease-in-out duration-200 mt-1"></span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </header>
