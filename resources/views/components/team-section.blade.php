<section class="modern-team-section py-8 bg-gray-100 relative overflow-hidden px-20">

    <div class="container mx-auto px-4 relative z-10">

        @if ($teams->isNotEmpty())
            <!-- Team Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-16 gap-y-4 mb-12">
                @foreach ($teams->take(4) as $index => $member)
                    <div class="team-card-wrapper w-[14rem]" data-aos="fade-up" data-aos-duration="800"
                        data-aos-delay="{{ $index * 100 }}">
                        <div
                            class="bg-white rounded-2xl shadow-md transition-all duration-500 group overflow-hidden border border-gray-100 hover:border-primary/30">
                            <!-- Team Member Image -->
                            <a href="{{ route('team.show', $member->slug) }}" class="block">
                                <div class="relative overflow-hidden">
                                    <div class="bg-gradient-to-br from-accent to-secondary/20">
                                        @if ($member->image)
                                            <img src="{{ $member->image_url }}" alt="{{ $member->name }}"
                                                class="w-full h-[18rem] object-fit object-center">
                                        @else
                                            <img src="{{ asset('assets/images/team/team-1-1.jpg') }}"
                                                alt="{{ $member->name }}"
                                                class="w-full h-full object-contain transition-transform duration-700 ease-out">
                                        @endif
                                    </div>

                                </div>
                            </a>

                            <!-- Team Member Info -->
                            <div class="px-4 py-2">
                                <h3
                                    class="font-medium text-lg text-gray-900 group-hover:text-primary transition-colors duration-300">
                                    <a href="{{ route('team.show', $member->slug) }}" class="text-primary">
                                        {{ $member->name }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 font-normal text-sm mb-2">
                                    {{ $member->designation ?: 'Legal Professional' }}</p>

                                <!-- Contact Info -->
                                <div class="space-y-2 text-xs text-gray-500">
                                    @if ($member->phone)
                                        <div class="flex space-x-2">
                                            <i class="fas fa-phone text-primary"></i>
                                            <a href="tel:{{ $member->phone }}"
                                                class="hover:text-primary transition-colors duration-300">
                                                {{ $member->phone }}
                                            </a>
                                        </div>
                                    @endif
                                    @if ($member->email)
                                        <div class="flex space-x-2">
                                            <i class="fas fa-envelope text-primary"></i>
                                            <a href="mailto:{{ $member->email }}"
                                                class="hover:text-primary transition-colors duration-300">
                                                {{ $member->email }}
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <!-- Social Media Icons (Footer) -->
                                <div class="flex justify-between space-x-3 mt-2 pt-2 border-t border-gray-100">
                                    <div class="flex space-x-3 w-[50%]">
                                        @if ($member->facebooklink)
                                            <a href="{{ $member->facebooklink }}" target="_blank"
                                                class="w-8 h-8 bg-accent rounded-full flex items-center justify-center text-white hover:bg-primary hover:text-white transition-all duration-300">
                                                <i class="fab fa-facebook-f text-xs"></i>
                                            </a>
                                        @endif
                                        @if ($member->linkedinlink)
                                            <a href="{{ $member->linkedinlink }}" target="_blank"
                                                class="w-8 h-8 bg-accent rounded-full flex items-center justify-center text-white hover:bg-secondary hover:text-white transition-all duration-300">
                                                <i class="fab fa-linkedin-in text-xs"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <a href="{{ route('team.show', $member->slug) }}"
                                        class="px-2 pt-2 bg-accent text-white text-xs font-semibold rounded-lg hover:bg-secondary transition-all duration-300 hover:scale-105">
                                        View more
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20" data-aos="fade-up">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-users text-3xl text-gray-400"></i>
                </div>
                <h4 class="text-2xl font-bold text-gray-800 mb-4">No team members available at the moment.</h4>
                <p class="text-gray-600 max-w-md mx-auto">Please check back later to meet our amazing team of legal
                    professionals.</p>
            </div>
        @endif

        @if ($showViewAll && $teams->isNotEmpty())
            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('team.index') }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-primary to-secondary text-white px-4 py-2 rounded-full font-semibold shadow-lg">
                    <span>View All Team Members</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>
        @endif
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-accent rounded-full blur-3xl opacity-60 animate-pulse"></div>
    <div
        class="absolute bottom-10 right-10 w-32 h-32 bg-primary/20 rounded-full blur-3xl opacity-40 animate-pulse delay-1000">
    </div>
</section>
