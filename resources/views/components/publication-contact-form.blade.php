<section class="contact-two pt-120 pb-120">
    <div class="container">
        <div class="row">
            <!-- Left Column - Contact Information -->
            <div class="col-lg-6">
                <div class="contact-info-card" style="
                    background: linear-gradient(135deg, #5a6c7d 0%, #4a5568 50%, #2d3748 100%);
                    border-radius: 15px;
                    padding: 60px 40px;
                    height: 100%;
                    color: white;
                    position: relative;
                    overflow: hidden;
                ">
                    <!-- Background Pattern -->
                    <div style="
                        position: absolute;
                        top: -50%;
                        right: -50%;
                        width: 200%;
                        height: 200%;
                        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
                        background-size: 30px 30px;
                        opacity: 0.3;
                    "></div>
                    
                    <div style="position: relative; z-index: 2;">
                        <h2 class="mb-4" style="
                            font-size: 28px;
                            font-weight: 600;
                            line-height: 1.3;
                            margin-bottom: 20px;
                        ">{{ $title }}</h2>
                        
                        <p class="mb-4" style="
                            font-size: 16px;
                            line-height: 1.6;
                            opacity: 0.9;
                            margin-bottom: 25px;
                        ">{{ $description }}</p>
                        
                        <p style="
                            font-size: 14px;
                            line-height: 1.5;
                            opacity: 0.8;
                            margin-bottom: 30px;
                        ">Please include your WhatsApp or Viber number in the phone section if you'd prefer a direct call from one of our legal professionals.</p>
                        
                        <p style="
                            font-size: 16px;
                            font-weight: 500;
                            margin-bottom: 30px;
                        ">We are here to provide trusted legal support tailored to your needs.</p>
                        
                        <!-- Contact Details -->
                        <div class="contact-details mb-4">
                            @if($globalProfile && $globalProfile->address)
                            <div class="d-flex align-items-start mb-3" style="gap: 12px;">
                                <i class="fas fa-map-marker-alt" style="font-size: 16px; margin-top: 2px; opacity: 0.8;"></i>
                                <span style="font-size: 14px; line-height: 1.5;">{{ $globalProfile->address }}</span>
                            </div>
                            @endif
                            
                            @if($globalProfile && ($globalProfile->phone1 || $globalProfile->phone2))
                            <div class="d-flex align-items-start mb-3" style="gap: 12px;">
                                <i class="fas fa-phone" style="font-size: 16px; margin-top: 2px; opacity: 0.8;"></i>
                                <div style="font-size: 14px; line-height: 1.5;">
                                    @if($globalProfile->phone1)
                                        <div>Phone: {{ $globalProfile->phone1 }}</div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            @if($globalProfile && $globalProfile->email)
                            <div class="d-flex align-items-start mb-4" style="gap: 12px;">
                                <i class="fas fa-envelope" style="font-size: 16px; margin-top: 2px; opacity: 0.8;"></i>
                                <span style="font-size: 14px; line-height: 1.5;">{{ $globalProfile->email }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- WhatsApp/Viber Section -->
                        @if($showSocialMedia && $globalProfile && ($globalProfile->whatsapp || $globalProfile->viber || $globalProfile->wechat_link))
                        <div class="mb-4">
                            <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 15px;">Connect with our professional lawyers in Nepal</h5>
                            <div class="d-flex gap-2" style="
                                background: rgba(255, 255, 255, 0.1);
                                padding: 12px;
                                border-radius: 8px;
                                backdrop-filter: blur(10px);
                            ">
                                @if($globalProfile->whatsapp)
                                <a href="{{ $globalProfile->whatsapp }}" class="social-icon" style="
                                    width: 40px;
                                    height: 40px;
                                    background: #25D366;
                                    border-radius: 8px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: white;
                                    text-decoration: none;
                                    transition: transform 0.3s ease;
                                " onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fab fa-whatsapp" style="font-size: 18px;"></i>
                                </a>
                                @endif
                                
                                @if($globalProfile->viber)
                                <a href="{{ $globalProfile->viber }}" class="social-icon" style="
                                    width: 40px;
                                    height: 40px;
                                    background: #665CAC;
                                    border-radius: 8px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: white;
                                    text-decoration: none;
                                    transition: transform 0.3s ease;
                                " onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fab fa-viber" style="font-size: 18px;"></i>
                                </a>
                                @endif
                                
                                @if($globalProfile->wechat_link)
                                <a href="{{ $globalProfile->wechat_link }}" class="social-icon" style="
                                    width: 40px;
                                    height: 40px;
                                    background: #1AAD19;
                                    border-radius: 8px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: white;
                                    text-decoration: none;
                                    transition: transform 0.3s ease;
                                " onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fab fa-weixin" style="font-size: 18px;"></i>
                                </a>
                                @endif
                                
                                <a href="#" class="social-icon" style="
                                    width: 40px;
                                    height: 40px;
                                    background: #0088cc;
                                    border-radius: 8px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: white;
                                    text-decoration: none;
                                    transition: transform 0.3s ease;
                                " onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fab fa-telegram" style="font-size: 18px;"></i>
                                </a>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Social Media Section -->
                        @if($showSocialMedia && $globalProfile && ($globalProfile->facebook_link || $globalProfile->linkedin_link || $globalProfile->instagram_link))
                        <div>
                            <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 15px;">Follow Our Law Firm on Social Media :</h5>
                            <div class="d-flex gap-2" style="
                                background: rgba(255, 255, 255, 0.1);
                                padding: 12px;
                                border-radius: 8px;
                                backdrop-filter: blur(10px);
                            ">
                                @if($globalProfile->facebook_link)
                                <a href="{{ $globalProfile->facebook_link }}" class="social-icon" style="
                                    width: 40px;
                                    height: 40px;
                                    background: #1877f2;
                                    border-radius: 8px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: white;
                                    text-decoration: none;
                                    transition: transform 0.3s ease;
                                " onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fab fa-facebook-f" style="font-size: 18px;"></i>
                                </a>
                                @endif
                                
                                @if($globalProfile->linkedin_link)
                                <a href="{{ $globalProfile->linkedin_link }}" class="social-icon" style="
                                    width: 40px;
                                    height: 40px;
                                    background: #0077b5;
                                    border-radius: 8px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: white;
                                    text-decoration: none;
                                    transition: transform 0.3s ease;
                                " onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fab fa-linkedin-in" style="font-size: 18px;"></i>
                                </a>
                                @endif
                                
                                @if($globalProfile->instagram_link)
                                <a href="{{ $globalProfile->instagram_link }}" class="social-icon" style="
                                    width: 40px;
                                    height: 40px;
                                    background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
                                    border-radius: 8px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: white;
                                    text-decoration: none;
                                    transition: transform 0.3s ease;
                                " onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fab fa-instagram" style="font-size: 18px;"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Contact Form -->
            <div class="col-lg-6">
                <div class="contact-form-card" style="
                    background: white;
                    border-radius: 15px;
                    padding: 40px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                    height: 100%;
                ">
                    <div class="form-header mb-4">
                        <h3 style="
                            color: #6b7280;
                            font-size: 14px;
                            font-weight: 600;
                            text-transform: uppercase;
                            letter-spacing: 1px;
                            margin-bottom: 8px;
                        ">{{ $subtitle }}</h3>
                    </div>
                    
                    <!-- Success/Error Messages -->
                    @if (session('success'))
                        <div class="alert alert-success mb-4" style="
                            background: #d1edff;
                            border: 1px solid #3b82f6;
                            color: #1e40af;
                            padding: 12px 16px;
                            border-radius: 8px;
                            font-size: 14px;
                        ">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger mb-4" style="
                            background: #fef2f2;
                            border: 1px solid #ef4444;
                            color: #dc2626;
                            padding: 12px 16px;
                            border-radius: 8px;
                            font-size: 14px;
                        ">
                            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                        </div>
                    @endif
                    
                    <form class="contact-form" action="{{ $formAction }}" method="POST">
                        @csrf
                        
                        <!-- Full Name -->
                        <div class="form-group mb-4">
                            <label style="
                                display: block;
                                font-size: 14px;
                                font-weight: 500;
                                color: #374151;
                                margin-bottom: 8px;
                            ">Full Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control" 
                                placeholder="Enter Your Full Name"
                                value="{{ old('name') }}"
                                required
                                style="
                                    width: 100%;
                                    height: 50px;
                                    border: 1px solid #d1d5db;
                                    border-radius: 8px;
                                    padding: 0 16px;
                                    font-size: 14px;
                                    color: #374151;
                                    background: #f9fafb;
                                    transition: all 0.3s ease;
                                "
                                onfocus="this.style.borderColor='#3b82f6'; this.style.background='white';"
                                onblur="this.style.borderColor='#d1d5db'; this.style.background='#f9fafb';"
                            >
                            @error('name')
                                <span class="text-danger" style="font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Email -->
                        <div class="form-group mb-4">
                            <label style="
                                display: block;
                                font-size: 14px;
                                font-weight: 500;
                                color: #374151;
                                margin-bottom: 8px;
                            ">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                class="form-control" 
                                placeholder="Enter Your Email"
                                value="{{ old('email') }}"
                                required
                                style="
                                    width: 100%;
                                    height: 50px;
                                    border: 1px solid #d1d5db;
                                    border-radius: 8px;
                                    padding: 0 16px;
                                    font-size: 14px;
                                    color: #374151;
                                    background: #f9fafb;
                                    transition: all 0.3s ease;
                                "
                                onfocus="this.style.borderColor='#3b82f6'; this.style.background='white';"
                                onblur="this.style.borderColor='#d1d5db'; this.style.background='#f9fafb';"
                            >
                            @error('email')
                                <span class="text-danger" style="font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Phone Number -->
                        <div class="form-group mb-4">
                            <label style="
                                display: block;
                                font-size: 14px;
                                font-weight: 500;
                                color: #374151;
                                margin-bottom: 8px;
                            ">Phone Number</label>
                            <input 
                                type="text" 
                                name="phone" 
                                class="form-control" 
                                placeholder="Enter Your Phone Number"
                                value="{{ old('phone') }}"
                                style="
                                    width: 100%;
                                    height: 50px;
                                    border: 1px solid #d1d5db;
                                    border-radius: 8px;
                                    padding: 0 16px;
                                    font-size: 14px;
                                    color: #374151;
                                    background: #f9fafb;
                                    transition: all 0.3s ease;
                                "
                                onfocus="this.style.borderColor='#3b82f6'; this.style.background='white';"
                                onblur="this.style.borderColor='#d1d5db'; this.style.background='#f9fafb';"
                            >
                            @error('phone')
                                <span class="text-danger" style="font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                          <!-- Subject -->
                        <div class="form-group mb-4">
                            <label style="
                                display: block;
                                font-size: 14px;
                                font-weight: 500;
                                color: #374151;
                                margin-bottom: 8px;
                            ">Subject</label>
                            <input 
                                type="text" 
                                name="subject" 
                                class="form-control" 
                                placeholder="Enter Your Full Name"
                                value="{{ old('subject') }}"
                                required
                                style="
                                    width: 100%;
                                    height: 50px;
                                    border: 1px solid #d1d5db;
                                    border-radius: 8px;
                                    padding: 0 16px;
                                    font-size: 14px;
                                    color: #374151;
                                    background: #f9fafb;
                                    transition: all 0.3s ease;
                                "
                                onfocus="this.style.borderColor='#3b82f6'; this.style.background='white';"
                                onblur="this.style.borderColor='#d1d5db'; this.style.background='#f9fafb';"
                            >
                            @error('subject')
                                <span class="text-danger" style="font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Message -->
                        <div class="form-group mb-4">
                            <label style="
                                display: block;
                                font-size: 14px;
                                font-weight: 500;
                                color: #374151;
                                margin-bottom: 8px;
                            ">Message</label>
                            <textarea 
                                name="message" 
                                class="form-control" 
                                placeholder="Enter your message"
                                rows="5"
                                required
                                style="
                                    width: 100%;
                                    border: 1px solid #d1d5db;
                                    border-radius: 8px;
                                    padding: 16px;
                                    font-size: 14px;
                                    color: #374151;
                                    background: #f9fafb;
                                    transition: all 0.3s ease;
                                    resize: vertical;
                                    font-family: inherit;
                                "
                                onfocus="this.style.borderColor='#3b82f6'; this.style.background='white';"
                                onblur="this.style.borderColor='#d1d5db'; this.style.background='#f9fafb';"
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-danger" style="font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- ReCaptcha -->
                        @if(env('GOOGLE_RECAPTCHA_KEY'))
                        <div class="form-group mb-4">
                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="text-danger" style="font-size: 12px; margin-top: 4px; display: block;">{{ $errors->first('g-recaptcha-response') }}</span>
                            @endif
                        </div>
                        @endif
                        
                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" style="
                                background: linear-gradient(135deg, #4f6378 0%, #3c4d5e 100%);
                                color: white;
                                border: none;
                                border-radius: 8px;
                                padding: 14px 30px;
                                font-size: 16px;
                                font-weight: 600;
                                cursor: pointer;
                                transition: all 0.3s ease;
                                width: auto;
                                min-width: 120px;
                            " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
