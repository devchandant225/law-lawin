<!-- Modern About Us Section -->
<section class="relative py-16 lg:py-24 bg-gradient-to-b from-gray-50 to-white overflow-hidden" id="about">
    <!-- Decorative Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-xl animate-blob">
        </div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-secondary rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-96 h-96 bg-primary/70 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000">
        </div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main About Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 xl:gap-20 items-center">
            <!-- Image Section - Left -->
            <div class="relative order-2 lg:order-1">
                <!-- Main Image Container -->
                <div class="relative">
                    <!-- Image with rounded corners and shadow -->
                    <div
                        class="relative overflow-hidden rounded-3xl bg-white p-6 sm:p-8 shadow-2xl transform hover:scale-[1.02] transition-all duration-500">
                        <img src="{{ asset('storage/' . $intro_home->image1) }}"
                            alt="{{ $intro_home->title ?? 'Legal Services' }}"
                            class="w-full h-auto object-contain max-h-96">

                        <!-- Subtle gradient overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-secondary/5 rounded-3xl pointer-events-none">
                        </div>
                    </div>



                    <!-- Decorative Elements -->
                    <div class="absolute -top-6 -left-6 w-20 h-20 bg-primary/10 rounded-full blur-lg"></div>
                    <div class="absolute -bottom-8 -left-8 w-28 h-28 bg-secondary/10 rounded-full blur-xl"></div>
                </div>
            </div>

            <!-- Content Section - Right -->
            <div class="space-y-8 order-1 lg:order-2">
                <!-- Section Header -->
                <div class="space-y-6">
                    <!-- Tagline Badge -->
                    <div
                        class="inline-flex items-center space-x-3 px-5 py-2 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-full border border-primary/20">
                        <svg class="w-5 h-5 text-primary" viewBox="0 0 23 23" fill="currentColor">
                            <path
                                d="M21.6562 20.875H10.7188C10.5115 20.875 10.3128 20.9573 10.1663 21.1038C10.0198 21.2503 9.9375 21.449 9.9375 21.6562C9.9375 21.8635 10.0198 22.0622 10.1663 22.2087C10.3128 22.3552 10.5115 22.4375 10.7188 22.4375H21.6562C21.8635 22.4375 22.0622 22.3552 22.2087 22.2087C22.3552 22.0622 22.4375 21.8635 22.4375 21.6562C22.4375 21.449 22.3552 21.2503 22.2087 21.1038C22.0622 20.9573 21.8635 20.875 21.6562 20.875Z" />
                        </svg>
                        <span class="text-sm font-semibold text-primary uppercase tracking-wider">About Us</span>
                    </div>

                    <!-- Main Title -->
                    <div class="space-y-4">
                        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                            <span class="bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
                                {{ $intro_home->title ?? 'Gandhi & Associates' }}
                            </span>
                        </h2>
                        <p
                            class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-transparent bg-gradient-to-r from-primary to-secondary bg-clip-text">
                            LAW FIRM IN NEPAL
                        </p>
                    </div>
                </div>

                <!-- Description Content -->
                <div class="space-y-6">
                    <div class="text-lg text-gray-600 max-w-none">
                        {!! $intro_home->desc_1 !!}
                    </div>
                </div>

                <!-- Call to Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <a href="{{ route('team.index') }}"
                        class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 text-white font-semibold rounded-xl hover:from-blue-800 hover:via-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 hover:shadow-xl shadow-lg">
                        <span>Meet Our Team</span>
                        <i class="fas fa-arrow-right ml-3 transition-transform group-hover:translate-x-1"></i>
                    </a>
                    <a href="/about"
                        class="inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-primary hover:text-primary hover:bg-primary/5 transition-all duration-300">
                        <span>How We Do It</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Description 2 Section Below -->
        @if ($intro_home->desc_2)
            <div class="mt-12 lg:mt-12">
                <div class="max-w-5xl mx-auto">
                    <!-- Description 2 Content -->
                    <div class="text-left">
                        <div class="text-lg text-gray-600 mx-auto">
                            {!! $intro_home->desc_2 !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
