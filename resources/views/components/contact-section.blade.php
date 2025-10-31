<!-- Modern Contact Section -->
<section class="relative py-8 overflow-hidden bg-white" id="contact" data-aos="fade-up" data-aos-duration="800">
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-7xl mx-auto">
            
            <!-- Left Column - Contact Information -->
            <div class="space-y-8 bg-gradient-to-br from-accent to-primary px-8 py-8 rounded-2xl shadow-xl" data-aos="fade-right" data-aos-delay="200">
                <!-- Header -->
                <div class="space-y-6">
                    <h2 class="text-xl lg:text-2xl font-semibold text-white leading-tight">
                        Get in Touch with Our Legal Experts
                    </h2>
                    <div class="space-y-2 text-gray-100 font-semibold">
                        <p class="text-base leading-relaxed">
                            Have a question or need legal assistance? Fill out our contact form and our team of experienced lawyers in Kathmandu, Nepal will get back to you promptly.
                        </p>
                        <p class="leading-relaxed">
                            Please include your WhatsApp or Viber number in the phone section if you'd prefer a direct call from one of our legal professionals.
                        </p>
                        <p class="leading-relaxed">
                            We are here to provide trusted legal support tailored to your needs.
                        </p>
                    </div>
                </div>
                
                @php
                    // Use only globalProfile for all contact info
                    $phoneNumbers = [];
                    if ($globalProfile) {
                        $phoneNumbers = array_filter([
                            $globalProfile->phone1 ?? null,
                            $globalProfile->phone2 ?? null,
                        ]);
                    }
                    $emailAddress = $globalProfile->email ?? null;
                    $address = $globalProfile->address ?? null;
                @endphp
                
                <!-- Contact Information -->
                <div class="space-y-3">
                    @if ($address)
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-6 h-6 text-white mt-1">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="text-gray-100">
                                <p class="font-medium">{{ $address }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if (!empty($phoneNumbers))
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-6 h-6 text-white mt-1">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="text-gray-100">
                                <p class="font-medium">
                                    Phone : 
                                    @foreach ($phoneNumbers as $phone)
                                        <a href="tel:{{ $phone }}" class="hover:text-white transition-colors duration-300">{{ $phone }}</a>{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    @endif
                    
                    @if ($emailAddress)
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-6 h-6 text-white mt-1">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="text-gray-100">
                                <a href="mailto:{{ $emailAddress }}" class="hover:text-underline transition-colors duration-300 font-medium">
                                    {{ $emailAddress }}
                                </a>
                                @if ($globalProfile && $globalProfile->email2)
                                    , <a href="mailto:{{ $globalProfile->email2 }}" class="hover:text-underline transition-colors duration-300">{{ $globalProfile->email2 }}</a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Connect Section -->
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-white">
                        Connect with our professional lawyers in Nepal :
                    </h3>
                    
                    <!-- Professional Communication Icons -->
                    <div class="flex space-x-3">
                        @if ($globalProfile && $globalProfile->whatsapp)
                            <a href="{{ $globalProfile->whatsapp }}" target="_blank" 
                               class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-green-500 hover:bg-accent hover:scale-110 transition-all duration-300 shadow-lg group">
                                <i class="fab fa-whatsapp text-xl group-hover:scale-110 transition-transform duration-300"></i>
                            </a>
                        @else
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-green-500 shadow-lg">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </div>
                        @endif
                        
                        @if ($globalProfile && $globalProfile->viber)
                            <a href="{{ $globalProfile->viber }}" target="_blank" 
                               class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-purple-600 hover:bg-accent hover:scale-110 transition-all duration-300 shadow-lg group">
                                <i class="fab fa-viber text-xl group-hover:scale-110 transition-transform duration-300"></i>
                            </a>
                        @else
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-purple-600 shadow-lg">
                                <i class="fab fa-viber text-xl"></i>
                            </div>
                        @endif
                        
                        @if ($globalProfile && $globalProfile->wechat_link)
                            <a href="{{ $globalProfile->wechat_link }}" target="_blank" 
                               class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-green-600 hover:bg-accent hover:scale-110 transition-all duration-300 shadow-lg group">
                                <i class="fab fa-weixin text-xl group-hover:scale-110 transition-transform duration-300"></i>
                            </a>
                        @else
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-green-600 shadow-lg">
                                <i class="fab fa-weixin text-xl"></i>
                            </div>
                        @endif
                        
                        <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-blue-500 shadow-lg">
                            <i class="fab fa-telegram text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media Section -->
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-white">
                        Follow Our Law Firm on Social Media :
                    </h3>
                    
                    <!-- Social Media Icons -->
                    <div class="flex space-x-3">
                        @if ($globalProfile && $globalProfile->facebook_link)
                            <a href="{{ $globalProfile->facebook_link }}" target="_blank" 
                               class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-blue-600 hover:bg-accent hover:scale-110 transition-all duration-300 shadow-lg group">
                                <i class="fab fa-facebook-f text-xl group-hover:scale-110 transition-transform duration-300"></i>
                            </a>
                        @else
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-blue-600 shadow-lg">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </div>
                        @endif
                        
                        @if ($globalProfile && $globalProfile->linkedin_link)
                            <a href="{{ $globalProfile->linkedin_link }}" target="_blank" 
                               class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-blue-700 hover:bg-accent hover:scale-110 transition-all duration-300 shadow-lg group">
                                <i class="fab fa-linkedin-in text-xl group-hover:scale-110 transition-transform duration-300"></i>
                            </a>
                        @else
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-blue-700 shadow-lg">
                                <i class="fab fa-linkedin-in text-xl"></i>
                            </div>
                        @endif
                        
                        <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-pink-500 shadow-lg">
                            <i class="fab fa-instagram text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Column - Contact Form -->
            @if ($showForm)
                <div class="space-y-4" data-aos="fade-left" data-aos-delay="300">
                    <!-- Form Header -->
                    <div class="bg-gray-100 rounded-2xl shadow-xl p-8">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-primary mb-2">
                             REACH OUT TO US AT ANY TIME
                            </h3>
                        </div>
                        
                        <!-- Success/Error Messages -->
                        @if (session('success'))
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-center space-x-2 text-green-700">
                                    <i class="fas fa-check-circle"></i>
                                    <span class="font-medium">{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex items-center space-x-2 text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span class="font-medium">{{ session('error') }}</span>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Contact Form -->
                        <form action="{{ $formAction }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <!-- Full Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input id="name" 
                                       type="text" 
                                       name="name" 
                                       placeholder="Enter Your Full Name"
                                       value="{{ old('name') }}" 
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-300 placeholder-gray-400">
                                @error('name')
                                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input id="email" 
                                       type="email" 
                                       name="email" 
                                       placeholder="Enter Your Email"
                                       value="{{ old('email') }}" 
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-300 placeholder-gray-400">
                                @error('email')
                                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Phone Number -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input id="phone" 
                                       type="text" 
                                       name="phone" 
                                       placeholder="Enter Your Phone Number"
                                       value="{{ old('phone') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-300 placeholder-gray-400">
                                @error('phone')
                                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                <textarea id="message" 
                                          name="message" 
                                          rows="4"
                                          placeholder="Enter your message"
                                          required
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-300 placeholder-gray-400 resize-none">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- ReCaptcha -->
                            @if (env('GOOGLE_RECAPTCHA_KEY'))
                                <div class="flex justify-center">
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                </div>
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-red-500 text-sm block text-center">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif
                            @endif
                            
                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-primary to-secondary text-white font-semibold py-4 px-6 rounded-lg hover:from-secondary hover:to-primary transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                                    <span class="flex items-center justify-center space-x-2">
                                        <span>submit</span>
                                        <i class="fas fa-paper-plane ml-2"></i>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
