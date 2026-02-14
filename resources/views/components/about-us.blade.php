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
        @if ($intro_home)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 xl:gap-20 items-center">
                <!-- Image Section - Left -->
                <div class="relative order-2 lg:order-1">
                    <!-- Main Image Container -->
                    <div class="relative">
                        <!-- Image with rounded corners and shadow -->
                        <div class="relative overflow-hidden rounded-xl p-6 sm:p-8 shadow">
                            <img src="{{ $intro_home->image1 ? asset('storage/' . $intro_home->image1) : asset('images/default-about.jpg') }}"
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
                        <!-- Main Title -->
                        <div class="space-y-4">
                            <h1 class="font-semibold text-gray-800 leading-tight">
                                <span class="text-primary text-3xl underline">
                                    {{ $intro_home->title ?? 'Lawin & Partners' }}
                                </span>
                            </h1>

                        </div>
                    </div>

                    <!-- Description Content -->
                    <div class="">
                        <div class="text-base text-gray-600 max-w-none text-justify">
                            {!! $intro_home->desc_1 !!}
                        </div>
                    </div>

                </div>
            </div>

            <!-- Description 2 Section Below -->
            @if ($intro_home->desc_2)
                <div class="mt-6 rounded-2xl">
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
        @else
            <!-- Fallback content when intro_home is not available -->
            <div class="text-center py-12">
                <h2 class="text-2xl font-bold text-gray-800">About Us</h2>
                <p class="text-gray-600 mt-4">Content is currently unavailable.</p>
            </div>
        @endif

        <!-- Second Section: Why Choose Us -->
        @if ($why_choose_home)
            <!-- Main About Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 xl:gap-20 items-center mt-16">
                <!-- Image Section - Left -->
                <div class="relative order-2 lg:order-1">
                    <!-- Main Image Container -->
                    <div class="relative">
                        <!-- Image with rounded corners and shadow -->
                        <div class="relative overflow-hidden rounded-xl p-6 sm:p-8 shadow">
                            <img src="{{ $why_choose_home->image1 ? asset('storage/' . $why_choose_home->image1) : asset('images/default-why-choose.jpg') }}"
                                alt="{{ $why_choose_home->title ?? 'Legal Services' }}"
                                class="w-full h-[30rem] object-cover rounded">

                            <!-- Subtle gradient overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-secondary/5 rounded-3xl pointer-events-none">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Content Section - Right -->
                <div class="">

                    <div class="">

                        <!-- Main Title -->
                        <div class="space-y-4">
                            <h2 class="font-semibold text-gray-800 leading-tight">
                                <span class="text-primary text-3xl underline">
                                    {{ $why_choose_home->title ?? 'Lawin & Partners' }}
                                </span>
                            </h2>

                        </div>
                    </div>
                    <!-- Description Content -->
                    <div class="">
                        <div class="text-base text-gray-600 max-w-none text-justify">
                            {!! $why_choose_home->desc_1 !!}
                        </div>
                    </div>
                    <!-- Section Header -->

                </div>
            </div>
        @else
            <!-- Fallback content when why_choose_home is not available -->
            <div class="text-center py-12 mt-16">
                <h2 class="text-2xl font-bold text-gray-800">Why Choose Us</h2>
                <p class="text-gray-600 mt-4">Content is currently unavailable.</p>
            </div>
        @endif

    </div>
</section>
