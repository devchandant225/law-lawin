{{-- CTA Section Component --}}
<section class="py-16 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-32 h-32 bg-primary rounded-full -translate-x-16 -translate-y-16"></div>
        <div class="absolute top-1/4 right-0 w-24 h-24 bg-primary rounded-full translate-x-12"></div>
        <div class="absolute bottom-0 left-1/4 w-20 h-20 bg-primary rounded-full -translate-y-10"></div>
        <div class="absolute bottom-1/4 right-1/3 w-16 h-16 bg-primary rounded-full"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <!-- Heading -->
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
                {{ $title ?? 'Ready to Get Started?' }}
            </h2>
            
            <!-- Subtext -->
            <p class="text-xl text-blue-100 mb-10 max-w-3xl mx-auto leading-relaxed">
                {{ $subtitle ?? 'Contact our experienced legal team today for professional guidance and expert advice on your legal matters.' }}
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <!-- Primary Button -->
                <a href="{{ $primaryUrl ?? route('contact') }}" 
                   class="bg-primary hover:bg-primary/90 inline-flex items-center justify-center gap-3 px-8 py-4 text-white font-bold text-lg rounded-xl hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 min-w-[200px]">
                    <i class="fas fa-phone"></i>
                    {{ $primaryText ?? 'Contact Us Now' }}
                </a>
                
                <!-- Secondary Button -->
                <a href="{{ $secondaryUrl ?? route('services.index') }}" 
                   class="bg-secondary hover:bg-secondary/90 inline-flex items-center justify-center gap-3 px-8 py-4 text-white font-semibold text-lg rounded-xl hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 min-w-[200px]">
                    <i class="fas fa-briefcase"></i>
                    {{ $secondaryText ?? 'View Services' }}
                </a>
            </div>
            
            <!-- Additional Info -->
            @if($showInfo ?? true)
            <div class="mt-12 flex flex-col sm:flex-row gap-8 justify-center items-center text-blue-100">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-white"></i>
                    </div>
                    <div>
                        <div class="font-semibold">24/7 Support</div>
                        <div class="text-sm opacity-90">Always available</div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white"></i>
                    </div>
                    <div>
                        <div class="font-semibold">Confidential</div>
                        <div class="text-sm opacity-90">100% Privacy guaranteed</div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <div>
                        <div class="font-semibold">Expert Team</div>
                        <div class="text-sm opacity-90">Professional lawyers</div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

