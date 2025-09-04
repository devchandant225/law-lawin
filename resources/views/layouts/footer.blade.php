<!-- Footer Design Matching Image -->
<footer class="bg-white border-t border-gray-200">
    <!-- Main Footer Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Column - Company Info & Social Media -->
            <div class="lg:col-span-1">
                <!-- Company Logo -->
                <div class="mb-6">
                    <a href="{{ route('home') }}" class="inline-block">
                        @if ($globalProfile && $globalProfile->logo_url)
                            <img src="{{ $globalProfile->logo_url }}" alt="{{ config('app.name') }}" class="h-16 w-auto">
                        @else
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="{{ config('app.name') }}"
                                class="h-16 w-auto">
                        @endif
                    </a>
                </div>

                <!-- Contact Information -->
                <div class="space-y-2 mb-6 text-lg text-gray-700">
                    @if ($globalProfile && $globalProfile->address)
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-map-marker-alt text-primary mt-0.5 flex-shrink-0"></i>
                            <span>{{ $globalProfile->address }}</span>
                        </div>
                    @else
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-map-marker-alt text-primary mt-0.5 flex-shrink-0"></i>
                            <span>Park Lane, Buddhanagar-10, Kathmandu, Nepal.</span>
                        </div>
                    @endif

                    @if (!empty(($phoneNumbers = array_filter([$globalProfile->phone1 ?? null, $globalProfile->phone2 ?? null]))))
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-phone text-primary flex-shrink-0"></i>
                            <div>
                                phone :
                                @foreach ($phoneNumbers as $phone)
                                    <a href="tel:{{ $phone }}"
                                        class="hover:text-primary transition-colors">{{ $phone }}</a>{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-phone text-primary flex-shrink-0"></i>
                            <span>phone : +9779808811027, +9779849964619</span>
                        </div>
                    @endif

                    @if ($globalProfile && $globalProfile->email)
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope text-primary flex-shrink-0"></i>
                            <a href="mailto:{{ $globalProfile->email }}"
                                class="hover:text-primary transition-colors">{{ $globalProfile->email }}</a>
                            @if ($globalProfile->email2)
                                , <a href="mailto:{{ $globalProfile->email2 }}"
                                    class="hover:text-primary transition-colors">{{ $globalProfile->email2 }}</a>
                            @endif
                        </div>
                    @else
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope text-primary flex-shrink-0"></i>
                            <span>info@lawbhandari.com , nabin@lawbhandari.com</span>
                        </div>
                    @endif
                </div>

                <!-- Follow Us Section -->
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-3">Follow Us</h4>
                    <div class="flex space-x-2">
                        @if ($globalProfile && $globalProfile->facebook_link)
                            <a href="{{ $globalProfile->facebook_link }}" target="_blank"
                                class="w-10 h-10 bg-blue-600 text-white rounded flex items-center justify-center hover:bg-blue-700 transition-colors duration-300">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                        @else
                            <div class="w-10 h-10 bg-blue-600 text-white rounded flex items-center justify-center">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </div>
                        @endif

                        @if ($globalProfile && $globalProfile->linkedin_link)
                            <a href="{{ $globalProfile->linkedin_link }}" target="_blank"
                                class="w-10 h-10 bg-blue-700 text-white rounded flex items-center justify-center hover:bg-blue-800 transition-colors duration-300">
                                <i class="fab fa-linkedin-in text-sm"></i>
                            </a>
                        @else
                            <div class="w-10 h-10 bg-blue-700 text-white rounded flex items-center justify-center">
                                <i class="fab fa-linkedin-in text-sm"></i>
                            </div>
                        @endif

                        <div class="w-10 h-10 bg-pink-500 text-white rounded flex items-center justify-center">
                            <i class="fab fa-instagram text-sm"></i>
                        </div>


                    </div>

                    <!-- Connect With Us Section -->
                    <div class="mt-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-3">Connect With Us</h4>
                        <div class="flex space-y-1 text-lg text-gray-600 gap-3">
                            @if ($globalProfile && $globalProfile->whatsapp)
                                <a href="{{ $globalProfile->whatsapp }}" target="_blank"
                                    class="w-10 h-10 bg-green-500 text-white rounded flex items-center justify-center hover:bg-green-600 transition-colors duration-300">
                                    <i class="fab fa-whatsapp text-sm"></i>
                                </a>
                            @else
                                <div class="w-10 h-10 bg-green-500 text-white rounded flex items-center justify-center">
                                    <i class="fab fa-whatsapp text-sm"></i>
                                </div>
                            @endif

                            @if ($globalProfile && $globalProfile->viber)
                                <a href="{{ $globalProfile->viber }}" target="_blank"
                                    class="w-10 h-10 bg-purple-600 text-white rounded flex items-center justify-center hover:bg-purple-700 transition-colors duration-300">
                                    <i class="fab fa-viber text-sm"></i>
                                </a>
                            @else
                                <div
                                    class="w-10 h-10 bg-purple-600 text-white rounded flex items-center justify-center">
                                    <i class="fab fa-viber text-sm"></i>
                                </div>
                            @endif

                            @if ($globalProfile && $globalProfile->wechat_link)
                                <a href="{{ $globalProfile->wechat_link }}" target="_blank"
                                    class="w-10 h-10 bg-green-600 text-white rounded flex items-center justify-center hover:bg-green-700 transition-colors duration-300">
                                    <i class="fab fa-weixin text-sm"></i>
                                </a>
                            @else
                                <div class="w-10 h-10 bg-green-600 text-white rounded flex items-center justify-center">
                                    <i class="fab fa-weixin text-sm"></i>
                                </div>
                            @endif

                            <div class="w-10 h-10 bg-blue-400 text-white rounded flex items-center justify-center">
                                <i class="fab fa-telegram text-sm"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle Column - Office Hours & Newsletter -->
            <div class="lg:col-span-1">
                <!-- Office Hours -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Office Hours</h3>
                    <div class="space-y-2 text-lg text-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-clock text-primary flex-shrink-0"></i>
                            <span>09:00 AM - 06:00 PM</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar text-primary flex-shrink-0"></i>
                            <span>Sunday - Friday</span>
                        </div>
                    </div>
                </div>

                <!-- Newsletter Signup -->
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Subscribe To Our News Letter</h3>
                    <form class="space-y-3" method="POST" action="#" id="newsletter-form">
                        @csrf
                        <div>
                            <input type="email" name="email" placeholder="Enter Your Email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary placeholder-gray-500">
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full bg-secondary text-white font-semibold py-3 px-4 rounded-md hover:bg-primary transition-colors duration-300 text-sm">
                                Subscribe Now
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Court Fee Calculator -->
                <div>
                    <a href="#"
                        class="inline-flex items-center text-gray-700 hover:text-primary transition-colors duration-300 group font-semibold text-lg">
                        <i class="fas fa-calculator mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                        Court FEE CALCULATOR OF NEPAL
                        <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Right Column - Direction/Map -->
            <div class="lg:col-span-1">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Direction</h3>

                <!-- Google Map -->
                <div class="rounded-lg overflow-hidden shadow-lg mb-4" style="height: 250px;">
                    @if ($globalProfile && $globalProfile->address)
                        <iframe
                            src="https://maps.google.com/maps?width=100%25&amp;height=250&amp;hl=en&amp;q={{ urlencode($globalProfile->address) }}&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Office Location Map"
                            class="w-full h-full">
                        </iframe>
                    @else
                        <iframe
                            src="https://maps.google.com/maps?width=100%25&amp;height=250&amp;hl=en&amp;q=Park+Lane,+Buddhanagar-10,+Kathmandu,+Nepal&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Default Location Map"
                            class="w-full h-full">
                        </iframe>
                    @endif
                </div>

            </div>
        </div>

    </div>

    <!-- Footer Bottom - Clean Design -->
    <div class="bg-gray-50 border-t border-gray-200">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                <!-- Copyright -->
                <div class="text-center md:text-left">
                    <p class="text-sm text-gray-600">
                        © <span class="dynamic-year"></span>, Lawin And Partners. All rights reserved..
                    </p>
                </div>

                <!-- Footer Links -->
                <div class="flex flex-wrap justify-center md:justify-end items-center space-x-6 text-sm">
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors duration-300">Law firm
                        in Nepal</a>
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors duration-300">Lawyers
                        in Nepal</a>
                    <a href="#"
                        class="text-gray-600 hover:text-primary transition-colors duration-300">Disclaimer</a>
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors duration-300">Terms of
                        use</a>
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors duration-300">Privacy
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
