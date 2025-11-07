<!-- Responsive Footer Design -->
<footer class="bg-white border-t border-gray-200">
    <!-- Main Footer Content -->
    <div class=" mx-auto px-4 sm:px-6 lg:px-12 py-8">
        <!-- Mobile: Single column, Tablet: 2 columns, Desktop: 3 columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-7 gap-8 lg:gap-12">

            <!-- Left Column - Company Info & Social Media -->
            <div class="col-span-2">
                <!-- Company Logo -->
                <div class="mb-6 text-center md:text-left">
                    <a href="{{ route('home') }}" class="inline-block">
                        @if ($globalProfile && $globalProfile->logo_url)
                            <img src="{{ $globalProfile->logo_url }}" alt="{{ config('app.name') }}"
                                class="h-12 sm:h-14 lg:h-16 w-auto">
                        @else
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="{{ config('app.name') }}"
                                class="h-12 sm:h-14 lg:h-16 w-auto">
                        @endif
                    </a>
                </div>

                <!-- Contact Information -->
                <div class="space-y-3 mb-6 text-sm sm:text-base font-semibold text-gray-700">
                    @if ($globalProfile && $globalProfile->address)
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-primary mt-1 flex-shrink-0 text-sm"></i>
                            @if ($globalProfile->google_map_link)
                                <a href="{{ $globalProfile->google_map_link }}" target="_blank" class="leading-relaxed hover:text-primary transition-colors duration-300 hover:underline">
                                    {{ $globalProfile->address }}
                                    <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                                </a>
                            @else
                                <span class="leading-relaxed">{{ $globalProfile->address }}</span>
                            @endif
                        </div>
                    @else
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-accent mt-1 flex-shrink-0 text-sm"></i>
                            <span class="leading-relaxed">Park Lane, Buddhanagar-8, Kathmandu, Nepal.</span>
                        </div>
                    @endif

                    @if (!empty(($phoneNumbers = array_filter([$globalProfile->phone1 ?? null, $globalProfile->phone2 ?? null]))))
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-phone text-accent mt-1 flex-shrink-0 text-sm"></i>
                            <div>
                                <span class="block sm:inline">phone : </span>
                                @foreach ($phoneNumbers as $phone)
                                    <a href="tel:{{ $phone }}"
                                        class="hover:text-accent transition-colors block sm:inline">{{ $phone }}</a>{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-phone text-accent mt-1 flex-shrink-0 text-sm"></i>
                            <div>
                                <span class="block sm:inline">phone : </span>
                                <span class="block sm:inline">+9779808811027, +9779849964619</span>
                            </div>
                        </div>
                    @endif

                    @if ($globalProfile && $globalProfile->email)
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-envelope text-accent mt-1 flex-shrink-0 text-sm"></i>
                            <div>
                                <a href="mailto:{{ $globalProfile->email }}"
                                    class="hover:text-primary transition-colors block sm:inline">{{ $globalProfile->email }}</a>
                                @if ($globalProfile->email2)
                                    <span class="hidden sm:inline">, </span>
                                    <a href="mailto:{{ $globalProfile->email2 }}"
                                        class="hover:text-primary transition-colors block sm:inline">{{ $globalProfile->email2 }}</a>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-envelope text-accent mt-1 flex-shrink-0 text-sm"></i>
                            <div>
                                <span class="block sm:inline">info@lawbhandari.com</span>
                                <span class="hidden sm:inline"> , </span>
                                <span class="block sm:inline">nabin@lawbhandari.com</span>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Follow Us Section -->

                <div class="flex gap-4">
                    <div class="">
                        <h4 class="text-base sm:text-lg font-bold text-accent mb-3 underline text-center md:text-left">
                            Follow Us</h4>
                        <div class="flex justify-center md:justify-start space-x-2 flex-wrap gap-y-2">
                            @if ($globalProfile && $globalProfile->facebook_link)
                                <a href="{{ $globalProfile->facebook_link }}" target="_blank"
                                    class="w-8 h-8 sm:w-8 sm:h-8 bg-blue-600 text-white rounded flex items-center justify-center hover:bg-blue-700 transition-colors duration-300">
                                    <i class="fab fa-facebook-f text-xs sm:text-sm"></i>
                                </a>
                            @else
                                <div
                                    class="w-8 h-8 sm:w-8 sm:h-8 bg-blue-600 text-white rounded flex items-center justify-center">
                                    <i class="fab fa-facebook-f text-xs sm:text-sm"></i>
                                </div>
                            @endif

                            @if ($globalProfile && $globalProfile->linkedin_link)
                                <a href="{{ $globalProfile->linkedin_link }}" target="_blank"
                                    class="w-8 h-8 sm:w-8 sm:h-8 bg-blue-700 text-white rounded flex items-center justify-center hover:bg-blue-800 transition-colors duration-300">
                                    <i class="fab fa-linkedin-in text-xs sm:text-sm"></i>
                                </a>
                            @else
                                <div
                                    class="w-8 h-8 sm:w-8 sm:h-8 bg-blue-700 text-white rounded flex items-center justify-center">
                                    <i class="fab fa-linkedin-in text-xs sm:text-sm"></i>
                                </div>
                            @endif

                            <div
                                class="w-8 h-8 sm:w-8 sm:h-8 bg-pink-500 text-white rounded flex items-center justify-center">
                                <i class="fab fa-instagram text-xs sm:text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Connect With Us Section -->
                    <div class="">
                        <h4 class="text-base sm:text-lg font-bold text-accent mb-3 underline text-center md:text-left">
                            Connect With Us</h4>
                        <div class="flex justify-center md:justify-start space-x-2 flex-wrap gap-y-2">
                            @if ($globalProfile && $globalProfile->whatsapp)
                                <a href="{{ $globalProfile->whatsapp }}" target="_blank"
                                    class="w-8 h-8 sm:w-8 sm:h-8 bg-green-500 text-white rounded flex items-center justify-center hover:bg-green-600 transition-colors duration-300">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                </a>
                            @else
                                <div
                                    class="w-8 h-8 sm:w-8 sm:h-8 bg-green-500 text-white rounded flex items-center justify-center">
                                    <i class="fab fa-whatsapp text-xs sm:text-sm"></i>
                                </div>
                            @endif

                            @if ($globalProfile && $globalProfile->viber)
                                <a href="{{ $globalProfile->viber }}" target="_blank"
                                    class="w-8 h-8 sm:w-8 sm:h-8 bg-purple-600 text-white rounded flex items-center justify-center hover:bg-purple-700 transition-colors duration-300">
                                    <i class="fab fa-viber text-xs sm:text-sm"></i>
                                </a>
                            @else
                                <div
                                    class="w-8 h-8 sm:w-8 sm:h-8 bg-purple-600 text-white rounded flex items-center justify-center">
                                    <i class="fab fa-viber text-xs sm:text-sm"></i>
                                </div>
                            @endif

                            @if ($globalProfile && $globalProfile->wechat_link)
                                <a href="{{ $globalProfile->wechat_link }}" target="_blank"
                                    class="w-8 h-8 sm:w-8 sm:h-8 bg-green-600 text-white rounded flex items-center justify-center hover:bg-green-700 transition-colors duration-300">
                                    <i class="fab fa-weixin text-xs sm:text-sm"></i>
                                </a>
                            @else
                                <div
                                    class="w-8 h-8 sm:w-8 sm:h-8 bg-green-600 text-white rounded flex items-center justify-center">
                                    <i class="fab fa-weixin text-xs sm:text-sm"></i>
                                </div>
                            @endif

                            <div
                                class="w-8 h-8 sm:w-8 sm:h-8 bg-blue-400 text-white rounded flex items-center justify-center">
                                <i class="fab fa-telegram text-xs sm:text-sm"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle Column - Office Hours & Newsletter -->
            <div class="col-span-2">
                <!-- Office Hours -->
                <div class="mb-8">
                    <h3 class="text-base sm:text-lg font-bold text-accent mb-4 underline text-center md:text-left">
                        Office Hours</h3>
                    <div class="space-y-2 text-sm font-bold  text-gray-700 text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start space-x-2">
                            <i class="fas fa-clock text-primary flex-shrink-0"></i>
                            <span>09:00 AM - 06:00 PM</span>
                        </div>
                        <div class="flex items-center justify-center md:justify-start space-x-2">
                            <i class="fas fa-calendar text-primary flex-shrink-0"></i>
                            <span>Sunday - Friday</span>
                        </div>
                    </div>
                </div>

                <!-- Newsletter Signup -->
                <div class="mb-6">
                    <h3 class="text-base sm:text-lg font-bold text-accent mb-4 underline text-center md:text-left">
                        Subscribe To Our News Letter</h3>
                    <form class="space-y-3 max-w-sm mx-auto md:mx-0" method="POST" action="#" id="newsletter-form">
                        @csrf
                        <div>
                            <input type="email" name="email" placeholder="Enter Your Email" required
                                class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-md text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary placeholder-gray-500">
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full bg-secondary text-white font-semibold py-2 sm:py-3 px-3 sm:px-4 rounded-md hover:bg-primary transition-colors duration-300 text-xs sm:text-sm">
                                Subscribe Now
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Court Fee Calculator -->
                <div class="text-center md:text-left">
                    <a href="/calculator"
                        class="inline-flex items-center text-gray-700 hover:text-primary transition-colors duration-300 group font-semibold text-sm sm:text-base lg:text-lg underline">
                        <i class="fas fa-calculator mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                        <span class="hidden sm:inline">Court FEE CALCULATOR OF NEPAL</span>
                        <span class="sm:hidden">Court Calculator</span>
                        <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Right Column - Direction/Map -->
            <div class="col-span-3">
                <h3 class="text-base sm:text-lg font-bold text-accent mb-4 underline text-center md:text-left">
                    Direction</h3>

                <!-- Google Map -->
                <div class="rounded-lg overflow-hidden shadow-lg mb-4 h-48 sm:h-56 lg:h-64 relative group">
                    @if ($globalProfile && $globalProfile->address)
                        <!-- Clickable overlay -->
                        @if ($globalProfile->google_map_link)
                            <a href="{{ $globalProfile->google_map_link }}" target="_blank" 
                               class="absolute inset-0 z-10 flex items-center justify-center bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
                                <div class="bg-white/90 backdrop-blur-sm rounded-lg px-4 py-2 flex items-center space-x-2 shadow-lg transform scale-90 group-hover:scale-100 transition-transform duration-300">
                                    <i class="fas fa-external-link-alt text-primary"></i>
                                    <span class="text-sm font-semibold text-gray-800">Open in Google Maps</span>
                                </div>
                            </a>
                        @endif
                        <iframe
                            src="https://maps.google.com/maps?width=100%25&amp;height=250&amp;hl=en&amp;q={{ urlencode($globalProfile->address) }}&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Office Location Map - Click to open in Google Maps"
                            class="w-full h-full transition-opacity duration-300 group-hover:opacity-80">
                        </iframe>
                    @else
                        <!-- Default fallback with static Google Maps link -->
                        <a href="https://www.google.com/maps/search/?api=1&query=Park+Lane,+Buddhanagar-8,+Kathmandu,+Nepal" target="_blank" 
                           class="absolute inset-0 z-10 flex items-center justify-center bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
                            <div class="bg-white/90 backdrop-blur-sm rounded-lg px-4 py-2 flex items-center space-x-2 shadow-lg transform scale-90 group-hover:scale-100 transition-transform duration-300">
                                <i class="fas fa-external-link-alt text-primary"></i>
                                <span class="text-sm font-semibold text-gray-800">Open in Google Maps</span>
                            </div>
                        </a>
                        <iframe
                            src="https://maps.google.com/maps?width=100%25&amp;height=250&amp;hl=en&amp;q=Park+Lane,+Buddhanagar-8,+Kathmandu,+Nepal&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Default Location Map - Click to open in Google Maps"
                            class="w-full h-full transition-opacity duration-300 group-hover:opacity-80">
                        </iframe>
                    @endif
                </div>
                
                <!-- Map Click Instructions -->
                <div class="text-center text-xs text-gray-500 mb-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Hover and click the map to open in Google Maps
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom - Clean Design -->
    <div class="bg-accent border-t border-gray-200">
        <div class="px-8 mx-auto py-2">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                <!-- Copyright -->
                <div class="text-center md:text-left">
                    <p class="text-sm text-gray-100">
                        © <span class="dynamic-year"></span>, Lawin And Partners. All rights reserved..
                    </p>
                </div>

                <!-- Footer Links -->
                <div class="flex flex-wrap justify-center md:justify-end items-center space-x-6 text-sm">
                   
                    <a href="/terms-of-service" class="text-gray-100 hover:text-white transition-colors duration-300">Terms of
                        Service</a>
                    <a href="/privacy-policy" class="text-gray-100 hover:text-white transition-colors duration-300">Privacy
                        Policy</a>
                    <a href="/cookie-policy-for-lawin-and-partners" class="text-gray-100 hover:text-white transition-colors duration-300">Cookies
                        Policy</a>
                </div>
            </div>
        </div>

    </div>
</footer>

<script>
    // Set current year
    document.querySelector('.dynamic-year').textContent = new Date().getFullYear();
</script>
