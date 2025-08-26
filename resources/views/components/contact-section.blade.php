@props([
    'contactInfo' => [
        'location' => $globalProfile->address ?? '123 Main St, City, Country',
        'phone1' => $globalProfile->phone1 ?? '+123 456 7890',
        'phone2' => $globalProfile->phone2 ?? '+123 456 7890',
        'email' => $globalProfile->email ?? 'info@lawinpartners.com',
        'workingHours' => [
            'weekdays' => 'Monday - Friday: 9:00 AM - 6:00 PM',
            'weekend' => 'Saturday - Sunday: 8:00 AM - 8:00 PM',
        ],
    ],
    'sectionTitle' => '<span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Contact Us</span>',
    'sectionSubtitle' => 'Get In Touch',
    'sectionDescription' => 'We\'re here to help with any questions you might have. Feel free to reach out to us and we\'ll get back to you as soon as possible.',
    'showSocialLinks' => true,
])

<section class="relative bg-gradient-to-br from-gray-50 via-white to-accent overflow-hidden py-10">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-grid-pattern opacity-[0.03]"></div>

    <!-- Floating Geometric Shapes -->
    <div class="absolute top-20 left-10 w-32 h-32 border-2 border-primary/20 rounded-full opacity-30 animate-float-slow">
    </div>
    <div class="absolute bottom-20 right-10 w-24 h-24 border-2 border-secondary/20 rounded-lg opacity-30 animate-float-reverse"
        style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 border-2 border-primary/20 rotate-45 opacity-30 animate-float-slow"
        style="animation-delay: 1s;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-10">
            <div
                class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                </svg>
                {{ $sectionSubtitle }}
            </div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                {!! $sectionTitle !!}
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ $sectionDescription }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
            <!-- Contact Information -->
            <div class="space-y-8">
                <!-- Contact Info Card -->
                <div
                    class="bg-gradient-to-br from-primary to-secondary p-1 rounded-2xl shadow">
                    <div class="bg-white rounded-2xl p-8 h-full">
                        <h3 class="text-2xl font-bold text-primary mb-3 flex items-center">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                </svg>
                            </div>
                            Reach out for the best Legal Advice
                        </h3>
                        <p>Feel free to drop your queries in the Contact Form. Your queries will be delivered in our
                            email box and our lawyers will get back to you through our email. We would also like to
                            request you to drop your whatsapp or viber number in phone section so that we can directly
                            call to address your queries if required.</p>
                        <br />
                        <p class="mb-2">We always focus on our client’s expectation, needs, practical commitments in solving their
                            legal problems. Our professional lawyers does toughest defense with proven results with
                            leading voice for defenseless.</p>
                        <div class="space-y-4">
                            <!-- Location -->
                            <div class="group">
                                <div
                                    class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-all duration-300 hover:shadow-md">
                                    <div
                                        class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mr-4 group-hover:bg-primary/20 transition-colors duration-300 flex-shrink-0">
                                        <svg class="w-5 h-5 text-primary" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Our Location</h4>
                                        <p class="leading-relaxed text-primary font-semibold">{{ $globalProfile->address }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="group">
                                <div
                                    class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-all duration-300 hover:shadow-md">
                                    <div
                                        class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mr-4 group-hover:bg-primary/20 transition-colors duration-300">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Phone Number</h4>
                                        <a href="tel:{{ $globalProfile->phone1 }}"
                                            class="text-primary font-medium hover:text-secondary transition-colors duration-300">{{ $globalProfile->phone1 }}</a>
                                        <a href="tel:{{ $globalProfile->phone1 }}"
                                            class="text-primary font-medium hover:text-secondary transition-colors duration-300">{{ $globalProfile->phone1 }}</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="group">
                                <div
                                    class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-all duration-300 hover:shadow-md">
                                    <div
                                        class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mr-4 group-hover:bg-primary/20 transition-colors duration-300">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Email Address</h4>
                                        <a href="mailto:{{ $contactInfo['email'] }}"
                                            class="text-primary font-medium hover:text-secondary transition-colors duration-300">{{ $contactInfo['email'] }}</a>
                                    </div>
                                </div>
                            </div>


                        </div>

                        @if ($showSocialLinks)
                            <!-- Social Links -->
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <h4 class="font-semibold text-gray-900 mb-4">Follow Us</h4>
                                <div class="flex space-x-3">
                                    <a href="#"
                                        class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition-all duration-300 hover:scale-110 shadow-md hover:shadow-lg">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                    </a>
                                    <a href="#"
                                        class="w-10 h-10 bg-blue-800 text-white rounded-lg flex items-center justify-center hover:bg-blue-900 transition-all duration-300 hover:scale-110 shadow-md hover:shadow-lg">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-container">
                <div
                    class="bg-accent rounded-2xl shadow border border-gray-100 p-8">
                    <h3 class="text-2xl font-bold text-primary mb-2">Send Us a Message</h3>
                    <p class="text-gray-600 mb-8">Fill out the form below and we'll get back to you as soon as possible
                    </p>

                    <form class="space-y-6" id="contactForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Your Name -->
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Your Name</label>
                                <div class="relative">
                                    <input type="text" name="name" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 hover:border-primary/50"
                                        placeholder="Enter your name">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                <div class="relative">
                                    <input type="email" name="email" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 hover:border-primary/50"
                                        placeholder="Enter your email">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Phone Number -->
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                <div class="relative">
                                    <input type="tel" name="phone"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 hover:border-primary/50"
                                        placeholder="Enter your phone number">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Subject -->
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
                                <div class="relative">
                                    <input type="text" name="subject"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 hover:border-primary/50"
                                        placeholder="Enter subject">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Your Message -->
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Your Message</label>
                            <textarea name="message" required rows="5"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 hover:border-primary/50 resize-none"
                                placeholder="Enter your message"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center pt-4">
                            <button type="submit"
                                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary to-secondary text-white font-semibold text-lg rounded-full transform transition-all duration-300 hover:scale-105 hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-primary/25 group">
                                <span class="mr-3">Send Message</span>
                                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Working Hours -->
                <div class="group mt-8">
                    <div
                        class="p-4 bg-accent rounded-xl hover:bg-primary/5 transition-all duration-300 hover:shadow-md">
                        <div class="flex items-start mb-3">
                            <div
                                class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mr-4 group-hover:bg-primary/20 transition-colors duration-300">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">Working Hours</h4>
                                <div class="space-y-2 text-gray-600">
                                    <p>{{ $contactInfo['workingHours']['weekdays'] }}</p>
                                    <p>{{ $contactInfo['workingHours']['weekend'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Contact Section Specific Styles */
    .contact-form-container {
        position: relative;
    }

    .contact-form-container::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        border-radius: 1rem;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .contact-form-container:hover::before {
        opacity: 0.1;
    }

    /* Form Input Animations */
    .form-group input:focus,
    .form-group textarea:focus {
        transform: translateY(-1px);
        box-shadow: 0 10px 25px -5px rgba(111, 100, 211, 0.1);
    }

    .form-group input:hover,
    .form-group textarea:hover {
        transform: translateY(-1px);
    }

    /* Pulse animation for submit button */
    @keyframes pulse-glow {

        0%,
        100% {
            box-shadow: 0 0 20px rgba(111, 100, 211, 0.3);
        }

        50% {
            box-shadow: 0 0 30px rgba(111, 100, 211, 0.5);
        }
    }

    button[type="submit"]:hover {
        animation: pulse-glow 2s infinite;
    }

    /* Enhanced shadow utilities */
    .shadow-3xl {
        box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
    }
</style>

<!-- Contact Form Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form data
                const formData = new FormData(form);
                const data = {};
                for (let [key, value] of formData.entries()) {
                    data[key] = value;
                }

                // Here you would typically send the data to your server
                // For now, we'll just show a success message
                showSuccessMessage();
            });
        }

        function showSuccessMessage() {
            // Create success message
            const message = document.createElement('div');
            message.className =
                'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full opacity-0 transition-all duration-300';
            message.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Message sent successfully!
                </div>
            `;

            document.body.appendChild(message);

            // Animate in
            setTimeout(() => {
                message.style.transform = 'translateX(0)';
                message.style.opacity = '1';
            }, 100);

            // Remove after 3 seconds
            setTimeout(() => {
                message.style.transform = 'translateX(full)';
                message.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(message);
                }, 300);
            }, 3000);

            // Reset form
            form.reset();
        }

        // Add floating label effect
        const inputs = form.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('label')?.classList.add('text-primary');
            });

            input.addEventListener('blur', function() {
                this.parentElement.querySelector('label')?.classList.remove('text-primary');
            });
        });
    });
</script>
