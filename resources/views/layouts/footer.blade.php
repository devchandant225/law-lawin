<!-- Modern Footer Design -->
<footer class="bg-gradient-to-br from-primary via-primary to-primary text-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
    
    <!-- Main Footer Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <!-- Flex Container: 30% Company Info, 20% Quick Links, 25% Google Map, 25% Facebook -->
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
            
            <!-- Company Info Section - 30% -->
            <div class="w-full lg:w-3/10 footer-section company-info">
                <!-- Company Logo -->
                <div class="mb-8 group">
                    <a href="{{ route('home') }}" class="inline-block transform transition-all duration-300 group-hover:scale-105">
                        @if ($globalProfile && $globalProfile->logo_url)
                            <img src="{{ asset('/Logo-Furusato.jpg') }}" alt="{{ config('app.name') }}"
                                class="h-16 lg:h-20 w-auto">
                        @else
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="{{ config('app.name') }}"
                                class="h-16 lg:h-20 w-auto">
                        @endif
                    </a>
                </div>

                <!-- Contact Information -->
                <div class="space-y-4 mb-8 text-sm lg:text-base">
                    @if ($globalProfile && $globalProfile->address)
                        <div class="flex items-start space-x-3 group contact-item">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center transition-colors duration-300">
                                <i class="fas fa-map-marker-alt text-primary text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <span class="text-white leading-relaxed">{{ $globalProfile->address }}</span>
                            </div>
                        </div>
                    @else
                        <div class="flex items-start space-x-3 group contact-item">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center transition-colors duration-300">
                                <i class="fas fa-map-marker-alt text-primary text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <span class="text-white leading-relaxed">Park Lane, Buddhanagar-8, Kathmandu, Nepal.</span>
                            </div>
                        </div>
                    @endif

                    @if (!empty(($phoneNumbers = array_filter([$globalProfile->phone1 ?? null, $globalProfile->phone2 ?? null]))))
                        <div class="flex items-start space-x-3 group contact-item">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center transition-colors duration-300">
                                <i class="fas fa-phone text-primary text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="space-y-1">
                                    @foreach ($phoneNumbers as $phone)
                                        <a href="tel:{{ $phone }}"
                                            class="block text-white hover:text-primary transition-colors duration-300">{{ $phone }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex items-start space-x-3 group contact-item">
                            <div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary/30 transition-colors duration-300">
                                <i class="fas fa-phone-alt text-primary text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="space-y-1">
                                    <span class="block text-white">+9779808811027</span>
                                    <span class="block text-white">+9779849964619</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($globalProfile && $globalProfile->email)
                        <div class="flex items-start space-x-3 group contact-item">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center transition-colors duration-300">
                                <i class="fas fa-envelope text-primary text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="space-y-1">
                                    <a href="mailto:{{ $globalProfile->email }}"
                                        class="block text-white hover:text-primary transition-colors duration-300">{{ $globalProfile->email }}</a>
                                    @if ($globalProfile->email2)
                                        <a href="mailto:{{ $globalProfile->email2 }}"
                                            class="block text-white hover:text-primary transition-colors duration-300">{{ $globalProfile->email2 }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex items-start space-x-3 group contact-item">
                            <div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary/30 transition-colors duration-300">
                                <i class="fas fa-envelope text-primary text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="space-y-1">
                                    <span class="block text-white">info@lawbhandari.com</span>
                                    <span class="block text-white">nabin@lawbhandari.com</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Social Media Links -->
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">Follow Us</h4>
                    <div class="flex space-x-3">
                        @if ($globalProfile && $globalProfile->facebook_link)
                            <a href="{{ $globalProfile->facebook_link }}" target="_blank"
                                class="w-12 h-12 bg-blue-600/20 backdrop-blur-sm border border-blue-600/30 text-blue-400 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transform hover:scale-110 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-blue-600/25">
                                <i class="fab fa-facebook-f text-lg"></i>
                            </a>
                        @else
                            <div class="w-12 h-12 bg-blue-600/20 backdrop-blur-sm border border-blue-600/30 text-blue-400 rounded-xl flex items-center justify-center">
                                <i class="fab fa-facebook-f text-lg"></i>
                            </div>
                        @endif

                        @if ($globalProfile && $globalProfile->linkedin_link)
                            <a href="{{ $globalProfile->linkedin_link }}" target="_blank"
                                class="w-12 h-12 bg-blue-700/20 backdrop-blur-sm border border-blue-700/30 text-blue-500 rounded-xl flex items-center justify-center hover:bg-blue-700 hover:text-white transform hover:scale-110 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-blue-700/25">
                                <i class="fab fa-linkedin-in text-lg"></i>
                            </a>
                        @else
                            <div class="w-12 h-12 bg-blue-700/20 backdrop-blur-sm border border-blue-700/30 text-blue-500 rounded-xl flex items-center justify-center">
                                <i class="fab fa-linkedin-in text-lg"></i>
                            </div>
                        @endif

                        @if ($globalProfile && $globalProfile->whatsapp)
                            <a href="{{ $globalProfile->whatsapp }}" target="_blank"
                                class="w-12 h-12 bg-green-500/20 backdrop-blur-sm border border-green-500/30 text-green-400 rounded-xl flex items-center justify-center hover:bg-green-500 hover:text-white transform hover:scale-110 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-green-500/25">
                                <i class="fab fa-whatsapp text-lg"></i>
                            </a>
                        @else
                            <div class="w-12 h-12 bg-green-500/20 backdrop-blur-sm border border-green-500/30 text-green-400 rounded-xl flex items-center justify-center">
                                <i class="fab fa-whatsapp text-lg"></i>
                            </div>
                        @endif

                        @if ($globalProfile && $globalProfile->viber)
                            <a href="{{ $globalProfile->viber }}" target="_blank"
                                class="w-12 h-12 bg-purple-600/20 backdrop-blur-sm border border-purple-600/30 text-purple-400 rounded-xl flex items-center justify-center hover:bg-purple-600 hover:text-white transform hover:scale-110 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-purple-600/25">
                                <i class="fab fa-viber text-lg"></i>
                            </a>
                        @else
                            <div class="w-12 h-12 bg-purple-600/20 backdrop-blur-sm border border-purple-600/30 text-purple-400 rounded-xl flex items-center justify-center">
                                <i class="fab fa-viber text-lg"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Links Section - 20% -->
            <div class="w-full lg:w-1/5 footer-section quick-links">
                <h3 class="text-lg lg:text-xl font-bold text-white mb-6 relative">
                    <span class="relative z-10">Quick Links</span>
                    <div class="absolute bottom-0 left-0 w-12 h-0.5 bg-gradient-to-r from-primary to-secondary transform origin-left transition-transform duration-300 hover:scale-x-150"></div>
                </h3>
                <nav class="space-y-3">
                    <a href="{{ route('home') }}" class="footer-link block text-white hover:text-white transition-all duration-300 group">
                        <span class="flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary/50 group-hover:text-primary mr-2 transform group-hover:translate-x-1 transition-all duration-300"></i>
                            Home
                        </span>
                    </a>
                    <a href="/about" class="footer-link block text-white hover:text-white transition-all duration-300 group">
                        <span class="flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary/50 group-hover:text-primary mr-2 transform group-hover:translate-x-1 transition-all duration-300"></i>
                            About Us
                        </span>
                    </a>
                    
                    <!-- Study Abroad Submenu -->
                    <div class="study-abroad-submenu">
                        <span class="footer-link block text-white font-medium mb-2">
                            <span class="flex items-center">
                                <i class="fas fa-chevron-right text-xs text-primary/50 mr-2"></i>
                                Study Abroad
                            </span>
                        </span>
                        <div class="ml-6 space-y-2">
                            <a href="/study-abroad/usa" class="footer-sub-link block text-white hover:text-white text-sm transition-all duration-300 group">
                                <span class="flex items-center">
                                    <i class="fas fa-angle-right text-xs text-primary/30 group-hover:text-primary mr-2 transform group-hover:translate-x-1 transition-all duration-300"></i>
                                    USA
                                </span>
                            </a>
                            <a href="/study-abroad/canada" class="footer-sub-link block text-white hover:text-white text-sm transition-all duration-300 group">
                                <span class="flex items-center">
                                    <i class="fas fa-angle-right text-xs text-primary/30 group-hover:text-primary mr-2 transform group-hover:translate-x-1 transition-all duration-300"></i>
                                    Canada
                                </span>
                            </a>
                            <a href="/study-abroad/japan" class="footer-sub-link block text-white hover:text-white text-sm transition-all duration-300 group">
                                <span class="flex items-center">
                                    <i class="fas fa-angle-right text-xs text-primary/30 group-hover:text-primary mr-2 transform group-hover:translate-x-1 transition-all duration-300"></i>
                                    Japan
                                </span>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('services.index') }}" class="footer-link block text-white hover:text-white transition-all duration-300 group">
                        <span class="flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary/50 group-hover:text-primary mr-2 transform group-hover:translate-x-1 transition-all duration-300"></i>
                            Our Services
                        </span>
                    </a>
                    <a href="{{ route('team.index') }}" class="footer-link block text-white hover:text-white transition-all duration-300 group">
                        <span class="flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary/50 group-hover:text-primary mr-2 transform group-hover:translate-x-1 transition-all duration-300"></i>
                            Our Team
                        </span>
                    </a>
                    <a href="/gallery" class="footer-link block text-white hover:text-white transition-all duration-300 group">
                        <span class="flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary/50 group-hover:text-primary mr-2 transform group-hover:translate-x-1 transition-all duration-300"></i>
                            Gallery
                        </span>
                    </a>
                    <a href="/contact" class="footer-link block text-white hover:text-white transition-all duration-300 group">
                        <span class="flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary/50 group-hover:text-primary mr-2 transform group-hover:translate-x-1 transition-all duration-300"></i>
                            Contact Us
                        </span>
                    </a>
                </nav>
            </div>

            <!-- Google Map Section - 25% -->
            <div class="w-full lg:w-1/4 footer-section map-section">
                <h3 class="text-lg lg:text-xl font-bold text-white mb-6 relative">
                    <span class="relative z-10">Find Us</span>
                    <div class="absolute bottom-0 left-0 w-12 h-0.5 bg-gradient-to-r from-primary to-secondary transform origin-left transition-transform duration-300 hover:scale-x-150"></div>
                </h3>
                
                <!-- Google Map -->
                <div class="relative rounded-2xl overflow-hidden shadow-2xl group h-64 lg:h-72">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent z-10 group-hover:from-black/10 transition-all duration-500"></div>
                    @if ($globalProfile && $globalProfile->address)
                        <iframe
                            src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q={{ urlencode($globalProfile->address) }}&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Office Location Map"
                            class="w-full h-full transform group-hover:scale-105 transition-transform duration-700 ease-out">
                        </iframe>
                    @else
                        <iframe
                            src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q=Park+Lane,+Buddhanagar-8,+Kathmandu,+Nepal&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Default Location Map"
                            class="w-full h-full transform group-hover:scale-105 transition-transform duration-700 ease-out">
                        </iframe>
                    @endif
                    <!-- Map overlay icon -->
                    <div class="absolute top-4 right-4 z-20 w-10 h-10 bg-primary/90 backdrop-blur-sm rounded-lg flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <i class="fas fa-external-link-alt text-sm"></i>
                    </div>
                </div>
                
                <!-- Map Info -->
                <div class="mt-4 p-4 bg-white/5 backdrop-blur-sm rounded-lg border border-white/10">
                    <div class="flex items-center space-x-2 text-sm text-white">
                        <i class="fas fa-map-marker-alt text-primary flex-shrink-0"></i>
                        <span>Visit our office for personalized consultation</span>
                    </div>
                </div>
            </div>

            <!-- Facebook Embed Section - 25% -->
            <div class="w-full lg:w-1/4 footer-section facebook-section">
                <h3 class="text-lg lg:text-xl font-bold text-white mb-6 relative">
                    <span class="relative z-10">Connect With Us</span>
                    <div class="absolute bottom-0 left-0 w-12 h-0.5 bg-gradient-to-r from-primary to-secondary transform origin-left transition-transform duration-300 hover:scale-x-150"></div>
                </h3>
                
                <!-- Facebook Page Embed -->
                <div class="relative rounded-2xl overflow-hidden shadow-2xl group h-64 lg:h-72">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent z-10 group-hover:from-black/10 transition-all duration-500"></div>
                    @if ($globalProfile && $globalProfile->facebook_link)
                        <!-- Extract Facebook page name from URL for embed -->
                        @php
                            $facebookUrl = $globalProfile->facebook_link;
                            $pageName = basename(parse_url($facebookUrl, PHP_URL_PATH));
                        @endphp
                        <div id="fb-root"></div>
                        <div class="fb-page" 
                             data-href="{{ $facebookUrl }}" 
                             data-tabs="timeline" 
                             data-width="" 
                             data-height="300" 
                             data-small-header="true" 
                             data-adapt-container-width="true" 
                             data-hide-cover="false" 
                             data-show-facepile="false">
                        </div>
                    @else
                        <!-- Fallback Facebook Widget -->
                        <div class="w-full h-full bg-gradient-to-br from-blue-900/20 to-blue-800/20 backdrop-blur-sm border border-blue-500/20 rounded-2xl flex flex-col items-center justify-center text-center p-6">
                            <div class="w-16 h-16 bg-blue-600/30 rounded-full flex items-center justify-center mb-4 transform group-hover:scale-110 transition-transform duration-300">
                                <i class="fab fa-facebook-f text-blue-400 text-2xl"></i>
                            </div>
                            <h4 class="text-white font-semibold mb-2">Follow Us on Facebook</h4>
                            <p class="text-white text-sm mb-4">Stay updated with our latest news and updates</p>
                            <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-300">
                                Visit Page
                            </a>
                        </div>
                    @endif
                </div>
                
                <!-- Newsletter Signup -->
                <div class="mt-6">
                    <h4 class="text-white font-semibold mb-4">Stay Updated</h4>
                    <form class="space-y-3" method="POST" action="#" id="newsletter-form">
                        @csrf
                        <div class="relative group">
                            <input type="email" name="email" placeholder="Enter your email" required
                                class="w-full px-4 py-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-300 group-hover:bg-white/15">
                            <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-primary/20 to-secondary/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                        </div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-primary to-secondary text-white font-semibold py-3 px-4 rounded-lg hover:from-primary/90 hover:to-secondary/90 transform hover:scale-105 hover:shadow-lg transition-all duration-300">
                            Subscribe Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom - Clean Design -->
    <div class="bg-primary border-t border-white/20">
        <div class="px-8 mx-auto py-2">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                <!-- Copyright -->
                <div class="text-center md:text-left">
                    <p class="text-sm text-white">
                        © <span class="dynamic-year"></span>, Furusato Education Center. All rights reserved..
                    </p>
                </div>

                <!-- Footer Links -->
                <div class="flex flex-wrap justify-center md:justify-end items-center space-x-6 text-sm">
                    <a href="#" class="text-white hover:text-white/80 transition-colors duration-300">Terms of
                        use</a>
                    <a href="#" class="text-white hover:text-white/80 transition-colors duration-300">Privacy
                        Policy</a>
                </div>
            </div>
        </div>

    </div>
</footer>

<!-- Custom Styles for Footer -->
<style>
/* Custom width classes for flex layout */
.lg\:w-3\/10 {
    width: 30%;
}

/* Background Grid Pattern */
.bg-grid-pattern {
    background-image: 
        linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px);
    background-size: 20px 20px;
}

/* Footer Section Animations */
.footer-section {
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
}

.footer-section:nth-child(1) { animation-delay: 0.1s; }
.footer-section:nth-child(2) { animation-delay: 0.2s; }
.footer-section:nth-child(3) { animation-delay: 0.3s; }
.footer-section:nth-child(4) { animation-delay: 0.4s; }

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Contact Item Hover Effects */
.contact-item {
    border-radius: 12px;
    padding: 8px;
    transition: all 0.3s ease;
}

.contact-item:hover {
    background: rgba(255, 255, 255, 0.05);
    transform: translateX(5px);
}

/* Quick Links Hover Effects */
.footer-link {
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.footer-link:before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    transition: left 0.5s;
}

.footer-link:hover:before {
    left: 100%;
}

.footer-link:hover {
    background: rgba(255, 255, 255, 0.05);
    transform: translateX(5px);
}

.footer-sub-link {
    padding: 6px 10px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.footer-sub-link:hover {
    background: rgba(255, 255, 255, 0.03);
    transform: translateX(3px);
}

/* Map and Facebook Section Hover Effects */
.map-section .group:hover iframe,
.facebook-section .group:hover .fb-page {
    transform: scale(1.02);
}

/* Newsletter Form Styling */
#newsletter-form input:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

#newsletter-form button:hover {
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .lg\:w-3\/10 {
        width: 100%;
    }
    
    .footer-section {
        margin-bottom: 2rem;
    }
    
    .footer-section:last-child {
        margin-bottom: 0;
    }
}

@media (max-width: 768px) {
    .contact-item {
        padding: 12px;
    }
    
    .footer-link {
        padding: 10px 0;
    }
    
    .footer-sub-link {
        padding: 8px 0;
    }
}

/* Loading Animation for Facebook Widget */
.facebook-section .fb-page {
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.facebook-section .fb-page:empty::before {
    content: 'Loading Facebook Feed...';
    color: #9CA3AF;
    font-size: 14px;
}

/* Scroll Reveal Animation */
@media (prefers-reduced-motion: no-preference) {
    .footer-section {
        animation-play-state: paused;
    }
    
    .footer-section.animate {
        animation-play-state: running;
    }
}
</style>

<!-- Facebook SDK -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0"></script>

<script>
    // Set current year
    document.addEventListener('DOMContentLoaded', function() {
        const yearElement = document.querySelector('.dynamic-year');
        if (yearElement) {
            yearElement.textContent = new Date().getFullYear();
        }
        
        // Initialize Facebook SDK
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v18.0'
            });
        };
        
        // Intersection Observer for scroll animations
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            // Observe all footer sections
            document.querySelectorAll('.footer-section').forEach(function(section) {
                observer.observe(section);
            });
        } else {
            // Fallback for browsers without Intersection Observer
            document.querySelectorAll('.footer-section').forEach(function(section) {
                section.classList.add('animate');
            });
        }
        
        // Enhanced newsletter form submission
        const newsletterForm = document.getElementById('newsletter-form');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const email = this.querySelector('input[name="email"]').value;
                const button = this.querySelector('button[type="submit"]');
                const originalText = button.textContent;
                
                // Add loading state
                button.textContent = 'Subscribing...';
                button.disabled = true;
                button.classList.add('opacity-75');
                
                // Simulate API call (replace with actual implementation)
                setTimeout(function() {
                    button.textContent = 'Subscribed!';
                    button.classList.remove('opacity-75');
                    button.classList.add('bg-green-600');
                    
                    setTimeout(function() {
                        button.textContent = originalText;
                        button.disabled = false;
                        button.classList.remove('bg-green-600');
                        newsletterForm.reset();
                    }, 2000);
                }, 1500);
            });
        }
        
        // Add smooth scroll to footer links
        document.querySelectorAll('.footer-link[href^="#"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add loading state for maps
        const mapIframes = document.querySelectorAll('.map-section iframe');
        mapIframes.forEach(function(iframe) {
            const container = iframe.parentElement;
            const loadingIndicator = document.createElement('div');
            loadingIndicator.className = 'absolute inset-0 flex items-center justify-center bg-gray-800/50 backdrop-blur-sm rounded-2xl z-20';
            loadingIndicator.innerHTML = '<div class="text-white text-sm">Loading map...</div>';
            
            container.appendChild(loadingIndicator);
            
            iframe.addEventListener('load', function() {
                loadingIndicator.remove();
            });
        });
    });
</script>
