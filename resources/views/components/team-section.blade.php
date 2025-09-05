<section class="modern-team-section py-16 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(59, 130, 246, 0.3) 1px, transparent 0); background-size: 30px 30px;"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">

        @if($teams->isNotEmpty())
        <!-- Team Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            @foreach($teams as $index => $member)
            <div class="team-card-wrapper" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $index * 100 }}">
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 group overflow-hidden border border-gray-100 hover:border-primary/30">
                    <!-- Team Member Image -->
                    <div class="relative overflow-hidden">
                        <div class="aspect-[4/5] bg-gradient-to-br from-accent to-secondary/20">
                            @if($member->image)
                                <img src="{{ $member->image_url }}" 
                                     alt="{{ $member->name }}" 
                                     class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                                <img src="{{ asset('assets/images/team/team-1-1.jpg') }}" 
                                     alt="{{ $member->name }}" 
                                     class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700 ease-out">
                            @endif
                        </div>
                        
                        <!-- Overlay with Social Links -->
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="flex justify-center space-x-3 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                    @if($member->facebooklink)
                                        <a href="{{ $member->facebooklink }}" 
                                           target="_blank" 
                                           class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-primary hover:scale-110 transition-all duration-300">
                                            <i class="fab fa-facebook-f text-sm"></i>
                                        </a>
                                    @endif
                                    @if($member->linkedinlink)
                                        <a href="{{ $member->linkedinlink }}" 
                                           target="_blank" 
                                           class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-secondary hover:scale-110 transition-all duration-300">
                                            <i class="fab fa-linkedin-in text-sm"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('team.show', $member->slug) }}" 
                                       class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-accent hover:text-primary hover:scale-110 transition-all duration-300">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Team Member Info -->
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-gray-900 mb-2 group-hover:text-primary transition-colors duration-300">
                            <a href="{{ route('team.show', $member->slug) }}" class="hover:text-primary transition-colors duration-300">
                                {{ $member->name }}
                            </a>
                        </h3>
                        <p class="text-gray-600 font-medium text-sm mb-4">{{ $member->designation ?: 'Legal Professional' }}</p>
                        
                        <!-- Contact Info -->
                        <div class="space-y-2 text-xs text-gray-500">
                            @if($member->phone)
                                <div class="flex space-x-2">
                                    <i class="fas fa-phone text-primary"></i>
                                    <a href="tel:{{ $member->phone }}" class="hover:text-primary transition-colors duration-300">
                                        {{ $member->phone }}
                                    </a>
                                </div>
                            @endif
                            @if($member->email)
                                <div class="flex space-x-2">
                                    <i class="fas fa-envelope text-primary"></i>
                                    <a href="mailto:{{ $member->email }}" class="hover:text-primary transition-colors duration-300">
                                        {{ $member->email }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Social Media Icons (Footer) -->
                        <div class="flex justify-center space-x-3 mt-4 pt-4 border-t border-gray-100">
                            @if($member->facebooklink)
                                <a href="{{ $member->facebooklink }}" 
                                   target="_blank" 
                                   class="w-8 h-8 bg-accent rounded-full flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all duration-300">
                                    <i class="fab fa-facebook-f text-xs"></i>
                                </a>
                            @endif
                            @if($member->linkedinlink)
                                <a href="{{ $member->linkedinlink }}" 
                                   target="_blank" 
                                   class="w-8 h-8 bg-accent rounded-full flex items-center justify-center text-secondary hover:bg-secondary hover:text-white transition-all duration-300">
                                    <i class="fab fa-linkedin-in text-xs"></i>
                                </a>
                            @endif
                            <a href="{{ route('team.show', $member->slug) }}" 
                               class="px-4 py-1.5 bg-primary text-white text-xs font-semibold rounded-full hover:bg-secondary transition-all duration-300 hover:scale-105">
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
            <p class="text-gray-600 max-w-md mx-auto">Please check back later to meet our amazing team of legal professionals.</p>
        </div>
        @endif
        
        @if($showViewAll && $teams->isNotEmpty())
        <div class="text-center" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('team.index') }}" 
               class="inline-flex items-center gap-2 bg-gradient-to-r from-primary to-secondary text-white px-8 py-4 rounded-full font-semibold text-lg hover:from-secondary hover:to-primary hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                <span>View All Team Members</span>
                <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
        @endif
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-accent rounded-full blur-3xl opacity-60 animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-primary/20 rounded-full blur-3xl opacity-40 animate-pulse delay-1000"></div>
</section>
