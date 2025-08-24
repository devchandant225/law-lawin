{{-- Events Section Component --}}
<section class="py-16 lg:py-24 bg-gradient-to-br from-gray-50 via-white to-primary/5 relative overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, #1e7e34 2px, transparent 2px); background-size: 40px 40px;"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                </svg>
                Upcoming Events
            </div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                Join Our 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Global Events</span>
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Connect with leading researchers, discover breakthrough innovations, and advance your knowledge at our world-class events.
            </p>
        </div>

        {{-- Events Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            {{-- Featured Event (Larger Card) --}}
            <div class="md:col-span-2 lg:col-span-1 lg:row-span-2">
                <div class="group bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 h-full">
                    <div class="relative">
                        <img src="https://picsum.photos/400/300?random=20" 
                             alt="International Plant Breeding Conference" 
                             class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent"></div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Featured</span>
                        </div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <div class="flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,2A2,2 0 0,1 14,4C14,4.74 13.6,5.39 13,5.73V7A1,1 0 0,0 14,8H18A1,1 0 0,0 19,7V5.73C18.4,5.39 18,4.74 18,4A2,2 0 0,1 20,2A2,2 0 0,1 22,4C22,4.74 21.6,5.39 21,5.73V7A3,3 0 0,1 18,10H14A3,3 0 0,1 11,7V5.73C10.4,5.39 10,4.74 10,4A2,2 0 0,1 12,2Z"/>
                                </svg>
                                March 15-18, 2024
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-2 text-primary text-sm font-medium mb-3">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z"/>
                            </svg>
                            Vienna, Austria
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-primary transition-colors duration-300">
                            International Plant Breeding Conference 2024
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Join over 800 researchers from 50+ countries for the most comprehensive plant breeding conference of the year. Featuring keynote speakers, workshop sessions, and networking opportunities.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-primary" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z"/>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">800+ Expected Attendees</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-secondary/10 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-secondary" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">Research Presentations</span>
                            </div>
                        </div>
                        <button class="w-full bg-gradient-to-r from-primary to-secondary text-white py-3 px-6 rounded-lg font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300 mt-6">
                            Register Now
                        </button>
                    </div>
                </div>
            </div>

            {{-- Regular Event Cards --}}
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="relative">
                    <img src="https://picsum.photos/400/200?random=21" 
                         alt="Sustainable Agriculture Workshop" 
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-semibold">Online</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 text-primary text-sm font-medium mb-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                        </svg>
                        Feb 28, 2024
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Sustainable Agriculture Workshop</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Learn cutting-edge sustainable farming techniques and their impact on crop breeding programs.
                    </p>
                    <button class="text-primary hover:text-secondary font-semibold text-sm hover:underline transition-colors duration-300">
                        Learn More →
                    </button>
                </div>
            </div>

            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="relative">
                    <img src="https://picsum.photos/400/200?random=22" 
                         alt="Genetics & Genomics Symposium" 
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-semibold">Hybrid</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 text-primary text-sm font-medium mb-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z"/>
                        </svg>
                        Tokyo, Japan • Mar 5, 2024
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Genetics & Genomics Symposium</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Explore the latest advances in plant genetics and genomic technologies for crop improvement.
                    </p>
                    <button class="text-primary hover:text-secondary font-semibold text-sm hover:underline transition-colors duration-300">
                        Learn More →
                    </button>
                </div>
            </div>

            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="relative">
                    <img src="https://picsum.photos/400/200?random=23" 
                         alt="Climate-Resilient Crops Webinar" 
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-purple-500 text-white px-2 py-1 rounded text-xs font-semibold">Webinar</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 text-primary text-sm font-medium mb-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                        </svg>
                        Mar 10, 2024
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Climate-Resilient Crops Webinar</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Discover strategies for developing crops that can withstand climate change challenges.
                    </p>
                    <button class="text-primary hover:text-secondary font-semibold text-sm hover:underline transition-colors duration-300">
                        Learn More →
                    </button>
                </div>
            </div>

            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="relative">
                    <img src="https://picsum.photos/400/200?random=24" 
                         alt="Young Breeders Conference" 
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-orange-500 text-white px-2 py-1 rounded text-xs font-semibold">In-Person</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 text-primary text-sm font-medium mb-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z"/>
                        </svg>
                        São Paulo, Brazil • Mar 22, 2024
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Young Breeders Conference</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        A conference dedicated to emerging plant breeders and students entering the field.
                    </p>
                    <button class="text-primary hover:text-secondary font-semibold text-sm hover:underline transition-colors duration-300">
                        Learn More →
                    </button>
                </div>
            </div>
        </div>

        {{-- Call to Action --}}
        <div class="text-center">
            <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 lg:p-12 text-white">
                <div class="max-w-3xl mx-auto">
                    <h3 class="text-2xl lg:text-3xl font-bold mb-4">Don't Miss Our Events!</h3>
                    <p class="text-lg mb-8 opacity-90">
                        Stay updated with the latest events, workshops, and conferences in plant breeding and agricultural science.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-300">
                            View All Events
                        </button>
                        <button class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary transition-all duration-300">
                            Subscribe to Updates
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
