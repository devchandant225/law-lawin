{{-- Mission & Vision Component --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                {{ $title ?? 'Our Mission & Vision' }}
            </h2>
            <div class="w-24 h-1 bg-primary mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                {{ $subtitle ?? 'Driving excellence through our core values and aspirations for the future' }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Mission Card -->
            <div class="group relative">
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 h-full border border-gray-100 hover:border-primary/20">
                    <!-- Icon -->
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mb-6 group-hover:bg-primary/20 transition-colors duration-300">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    
                    <!-- Content -->
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ $mission ?? 'To provide exceptional education consulting services that empower students to achieve their academic dreams abroad. We are committed to delivering personalized guidance, comprehensive support, and expert advice throughout every step of the study abroad journey.' }}
                    </p>
                    
                    <!-- Features List -->
                    <ul class="space-y-3">
                        <li class="flex items-center text-sm text-gray-600">
                            <div class="w-2 h-2 bg-primary rounded-full mr-3 flex-shrink-0"></div>
                            Expert Educational Guidance
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <div class="w-2 h-2 bg-primary rounded-full mr-3 flex-shrink-0"></div>
                            Personalized Student Support
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <div class="w-2 h-2 bg-primary rounded-full mr-3 flex-shrink-0"></div>
                            Comprehensive Application Assistance
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Vision Card -->
            <div class="group relative">
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 h-full border border-gray-100 hover:border-secondary/20">
                    <!-- Icon -->
                    <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mb-6 group-hover:bg-secondary/20 transition-colors duration-300">
                        <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    
                    <!-- Content -->
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ $vision ?? 'To become the most trusted and innovative education consultancy in Nepal, recognized for transforming students\' lives through quality education opportunities worldwide. We envision a future where every deserving student has access to world-class education regardless of their background.' }}
                    </p>
                    
                    <!-- Features List -->
                    <ul class="space-y-3">
                        <li class="flex items-center text-sm text-gray-600">
                            <div class="w-2 h-2 bg-secondary rounded-full mr-3 flex-shrink-0"></div>
                            Global Education Access
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <div class="w-2 h-2 bg-secondary rounded-full mr-3 flex-shrink-0"></div>
                            Innovation in Consulting
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <div class="w-2 h-2 bg-secondary rounded-full mr-3 flex-shrink-0"></div>
                            Transformative Student Experiences
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
