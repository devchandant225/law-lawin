<!-- Modern About Us Section -->
<section class="relative py-16 lg:py-12 bg-gradient-to-b from-gray-50 to-white overflow-hidden" id="about">
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
                        class="relative overflow-hidden rounded-xl p-6 sm:p-8 shadow">
                        <img src="{{ asset('storage/' . $intro_home->image1) }}"
                            alt="{{ $intro_home->title ?? 'Legal Services' }}"
                            class="w-full h-[30rem] object-cover rounded">

                        <!-- Subtle gradient overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-secondary/5 rounded-3xl pointer-events-none">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Content Section - Right -->
            <div class="space-y-8 order-1 lg:order-2">
                <!-- Section Header -->
                <div class="space-y-6">
                    <!-- Tagline Badge -->
                    <div class="inline-flex items-center space-x-3 px-5 py-2 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-full border border-primary/20">
                        <span class="text-sm font-semibold text-primary uppercase tracking-wider">About Us</span>
                    </div>

                    <!-- Main Title -->
                    <div class="space-y-4">
                        <h2 class="font-semibold text-gray-800 leading-tight">
                            <span class="text-primary text-3xl underline">
                                {{ $intro_home->title ?? 'Lawin & Partners' }}
                            </span>
                        </h2>
                       
                    </div>
                </div>

                <!-- Description Content -->
                <div class="">
                    <div class="text-base text-gray-600 max-w-none text-justify">
                        {!! $intro_home->desc_1 !!}
                    </div>
                </div>

                <!-- Call to Action Buttons -->
                {{-- <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <a href="{{ route('team.index') }}"
                        class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-primary via-secondary to-primary text-white font-semibold rounded-xl hover:from-secondary hover:via-primary hover:to-secondary transition-all duration-300 transform hover:scale-105 hover:shadow-xl shadow-lg">
                        <span>Meet Our Team</span>
                        <i class="fas fa-arrow-right ml-3 transition-transform group-hover:translate-x-1"></i>
                    </a>
                    <a href="/about"
                        class="inline-flex items-center justify-center px-8 py-4 border-2 border-primary/30 text-primary font-semibold rounded-xl hover:border-primary hover:text-white hover:bg-primary transition-all duration-300">
                        <span>How We Do It</span>
                    </a>
                </div> --}}
            </div>
        </div>

        <!-- Description 2 Section Below -->
        @if ($intro_home->desc_2)
            <div class="mt-12 lg:mt-12 rounded-2xl p-6">
                <div class="mx-auto">
                    <!-- Description 2 Content -->
                    <div class="text-left">
                        <div class="text-base text-gray-600 mx-auto text-justify">
                            {!! $intro_home->desc_2 !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
