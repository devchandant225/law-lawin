<!-- Modern Footer -->
<footer class="bg-gray-100 text-gray-800 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(0,0,0,0.1) 1px, transparent 0); background-size: 20px 20px;"></div>
    </div>

    <div class="relative z-10">
        <!-- Main Footer Content -->
        <div class="container mx-auto px-4 py-12 lg:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                
                <!-- Company Info & Office Hours Column -->
                <div class="lg:col-span-1">
                    <!-- Company Logo and Info -->
                    <div class="mb-8">
                        <!-- Dynamic Logo -->
                        <div class="mb-6">
                            <a href="{{ route('home') }}" class="inline-block">
                                @if ($globalProfile && $globalProfile->logo_url)
                                    <img src="{{ $globalProfile->logo_url }}" 
                                         width="200" 
                                         alt="{{ config('app.name') }}"
                                         class="h-16 w-auto">
                                @else
                                    <img src="assets/images/logo-dark.png" 
                                         width="200" 
                                         alt="{{ config('app.name') }}"
                                         class="h-16 w-auto">
                                @endif
                            </a>
                        </div>
                        
                        <!-- Contact Info -->
                        <div class="space-y-3 mb-6">
                            @if ($globalProfile && $globalProfile->address)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-5 h-5 text-gray-600 mt-1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="text-gray-700">
                                        {{ $globalProfile->address }}
                                    </div>
                                </div>
                            @else
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-5 h-5 text-gray-600 mt-1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="text-gray-700">
                                        Park Lane, Buddhanagar-10, Kathmandu, Nepal.
                                    </div>
                                </div>
                            @endif
                            
                            @if ($globalProfile && $globalProfile->phone1)
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-5 h-5 text-gray-600">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <a href="tel:{{ $globalProfile->phone1 }}" 
                                           class="text-gray-700 hover:text-blue-600 transition-colors duration-300">
                                            phone : {{ $globalProfile->phone1 }}
                                        </a>
                                        @if ($globalProfile->phone2)
                                            , <a href="tel:{{ $globalProfile->phone2 }}" 
                                                 class="text-gray-700 hover:text-blue-600 transition-colors duration-300">
                                                {{ $globalProfile->phone2 }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-5 h-5 text-gray-600">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="text-gray-700">
                                        phone : +97798088112027, +9779849964619
                                    </div>
                                </div>
                            @endif
                            
                            @if ($globalProfile && $globalProfile->email)
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-5 h-5 text-gray-600">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <a href="mailto:{{ $globalProfile->email }}" 
                                           class="text-gray-700 hover:text-blue-600 transition-colors duration-300">
                                            {{ $globalProfile->email }}
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-5 h-5 text-gray-600">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="text-gray-700">
                                        info@lawbhandari.com , nabin@lawbhandari.com
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Office Hours -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Office Hours</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 text-gray-600">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <span class="text-gray-700">09:00 AM - 06:00 PM</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 text-gray-600">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <span class="text-gray-700">Sunday - Friday</span>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Subscribe To Our News Letter</h3>
                        <form class="space-y-3" method="POST" action="#" id="newsletter-form">
                            @csrf
                            <div class="relative">
                                <input 
                                    type="email" 
                                    name="email"
                                    placeholder="Enter Your Email"
                                    required
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500 text-gray-800 pr-32"
                                >
                                <button 
                                    type="submit"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gray-600 text-white font-semibold py-2 px-6 rounded-md hover:bg-gray-700 transition-colors duration-300"
                                >
                                    Subscribe Now
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Court Fee Calculator Link -->
                    <div class="mb-8">
                        <a href="#" 
                           class="inline-flex items-center text-gray-700 hover:text-blue-600 transition-colors duration-300 group font-medium">
                            <i class="fas fa-calculator mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                            Court FEE CALCULATOR OF NEPAL
                            <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Direction Column -->
                <div class="lg:col-span-2">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Direction</h3>
                    
                    <!-- Google Map -->
                    <div class="rounded-lg overflow-hidden shadow-lg h-80 mb-6">
                        @if ($globalProfile && $globalProfile->address)
                            <!-- Google Maps Embed with Search Query -->
                            <iframe
                                src="https://maps.google.com/maps?width=100%25&amp;height=320&amp;hl=en&amp;q={{ urlencode($globalProfile->address) }}&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                                width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" title="Office Location Map"
                                class="w-full h-full">
                            </iframe>
                        @else
                            <!-- Default Map for Kathmandu, Nepal -->
                            <iframe
                                src="https://maps.google.com/maps?width=100%25&amp;height=320&amp;hl=en&amp;q=Park+Lane,+Buddhanagar-10,+Kathmandu,+Nepal&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                                width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" title="Default Location Map"
                                class="w-full h-full">
                            </iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="border-t border-gray-300 bg-gray-50">
            <div class="container mx-auto px-4 py-6">
                <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                    <div class="text-center lg:text-left">
                        <p class="text-gray-600 text-sm">
                            © <span class="dynamic-year"></span>, {{ config('app.name') }}. All rights reserved..
                        </p>
                    </div>
                    
                    <!-- Social Links and Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                        <!-- Follow Us Links -->
                        <div class="flex items-center space-x-2">
                            <h4 class="text-sm font-semibold text-gray-700 mr-2">Follow Us</h4>
                            <div class="flex space-x-2">
                                @if ($globalProfile && $globalProfile->facebook_link)
                                    <a href="{{ $globalProfile->facebook_link }}" 
                                       target="_blank"
                                       class="w-8 h-8 bg-blue-600 text-white rounded flex items-center justify-center hover:bg-blue-700 transition-colors duration-300">
                                        <i class="fab fa-facebook-f text-xs"></i>
                                    </a>
                                @else
                                    <a href="#" 
                                       class="w-8 h-8 bg-blue-600 text-white rounded flex items-center justify-center hover:bg-blue-700 transition-colors duration-300">
                                        <i class="fab fa-facebook-f text-xs"></i>
                                    </a>
                                @endif

                                @if ($globalProfile && $globalProfile->linkedin_link)
                                    <a href="{{ $globalProfile->linkedin_link }}" 
                                       target="_blank"
                                       class="w-8 h-8 bg-blue-700 text-white rounded flex items-center justify-center hover:bg-blue-800 transition-colors duration-300">
                                        <i class="fab fa-linkedin-in text-xs"></i>
                                    </a>
                                @else
                                    <a href="#" 
                                       class="w-8 h-8 bg-blue-700 text-white rounded flex items-center justify-center hover:bg-blue-800 transition-colors duration-300">
                                        <i class="fab fa-linkedin-in text-xs"></i>
                                    </a>
                                @endif

                                <a href="#" 
                                   class="w-8 h-8 bg-pink-500 text-white rounded flex items-center justify-center hover:bg-pink-600 transition-colors duration-300">
                                    <i class="fab fa-instagram text-xs"></i>
                                </a>

                                @if ($globalProfile && $globalProfile->whatsapp)
                                    <a href="{{ $globalProfile->whatsapp }}" 
                                       target="_blank"
                                       class="w-8 h-8 bg-green-500 text-white rounded flex items-center justify-center hover:bg-green-600 transition-colors duration-300">
                                        <i class="fab fa-whatsapp text-xs"></i>
                                    </a>
                                @else
                                    <a href="#" 
                                       class="w-8 h-8 bg-green-500 text-white rounded flex items-center justify-center hover:bg-green-600 transition-colors duration-300">
                                        <i class="fab fa-whatsapp text-xs"></i>
                                    </a>
                                @endif

                                @if ($globalProfile && $globalProfile->viber)
                                    <a href="{{ $globalProfile->viber }}" 
                                       target="_blank"
                                       class="w-8 h-8 bg-purple-600 text-white rounded flex items-center justify-center hover:bg-purple-700 transition-colors duration-300">
                                        <i class="fab fa-viber text-xs"></i>
                                    </a>
                                @else
                                    <a href="#" 
                                       class="w-8 h-8 bg-purple-600 text-white rounded flex items-center justify-center hover:bg-purple-700 transition-colors duration-300">
                                        <i class="fab fa-viber text-xs"></i>
                                    </a>
                                @endif

                                @if ($globalProfile && $globalProfile->wechat_link)
                                    <a href="{{ $globalProfile->wechat_link }}" 
                                       target="_blank"
                                       class="w-8 h-8 bg-green-600 text-white rounded flex items-center justify-center hover:bg-green-700 transition-colors duration-300">
                                        <i class="fab fa-weixin text-xs"></i>
                                    </a>
                                @else
                                    <a href="#" 
                                       class="w-8 h-8 bg-green-600 text-white rounded flex items-center justify-center hover:bg-green-700 transition-colors duration-300">
                                        <i class="fab fa-weixin text-xs"></i>
                                    </a>
                                @endif

                                <a href="#" 
                                   class="w-8 h-8 bg-blue-400 text-white rounded flex items-center justify-center hover:bg-blue-500 transition-colors duration-300">
                                    <i class="fab fa-telegram text-xs"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Connect With Us Links -->
                        <div class="flex items-center space-x-2">
                            <h4 class="text-sm font-semibold text-gray-700 mr-2">Connect With Us</h4>
                            <div class="flex space-x-3">
                                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-300 text-sm">Law firm in Nepal</a>
                                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-300 text-sm">Lawyers in Nepal</a>
                                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-300 text-sm">Disclaimer</a>
                                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-300 text-sm">Terms of use</a>
                                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-300 text-sm">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Action Buttons -->
        <div class="fixed bottom-6 right-6 z-50 flex flex-col space-y-3">
            <!-- WhatsApp Button -->
            @if ($globalProfile && $globalProfile->whatsapp)
                <a href="{{ $globalProfile->whatsapp }}" 
                   target="_blank"
                   class="bg-green-500 text-white p-3 rounded-full shadow-lg hover:bg-green-600 hover:scale-110 transition-all duration-300 group">
                    <i class="fab fa-whatsapp text-lg"></i>
                    <span class="absolute right-full mr-3 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white text-xs py-1 px-2 rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">WhatsApp</span>
                </a>
            @else
                <a href="#" 
                   class="bg-green-500 text-white p-3 rounded-full shadow-lg hover:bg-green-600 hover:scale-110 transition-all duration-300 group">
                    <i class="fab fa-whatsapp text-lg"></i>
                    <span class="absolute right-full mr-3 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white text-xs py-1 px-2 rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">WhatsApp</span>
                </a>
            @endif
            
            <!-- Call Now Button -->
            @if ($globalProfile && $globalProfile->phone1)
                <a href="tel:{{ $globalProfile->phone1 }}" 
                   class="bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 hover:scale-110 transition-all duration-300 group">
                    <i class="fas fa-phone text-lg"></i>
                    <span class="absolute right-full mr-3 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white text-xs py-1 px-2 rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">Call Now</span>
                </a>
            @else
                <a href="tel:+97798088112027" 
                   class="bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 hover:scale-110 transition-all duration-300 group">
                    <i class="fas fa-phone text-lg"></i>
                    <span class="absolute right-full mr-3 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white text-xs py-1 px-2 rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">Call Now</span>
                </a>
            @endif
        </div>
    </div>
</footer>

    <script>
        // Set current year
        document.querySelector('.dynamic-year').textContent = new Date().getFullYear();

        // Newsletter form handling
        document.getElementById('newsletter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your newsletter subscription logic here
            console.log('Newsletter subscription submitted');
        });

        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add animation on scroll (optional)
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe footer elements for animation
        document.querySelectorAll('footer .container > div > div').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>