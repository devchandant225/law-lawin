{{-- Floating Contact Component --}}
@if ($globalProfile && ($globalProfile->whatsapp || $globalProfile->viber || $globalProfile->phone1))
    <div id="floating-contact" class="floating-contact">
        <!-- Main contact button -->
        <div class="floating-contact__main-btn" id="contactToggle">
            <i class="fas fa-comments"></i>
            <span class="floating-contact__close-icon">
                <i class="fas fa-times"></i>
            </span>
        </div>

        <!-- Contact options -->
        <div class="floating-contact__options" id="contactOptions">
            @if ($globalProfile->whatsapp)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $globalProfile->whatsapp) }}" target="_blank"
                    class="floating-contact__option floating-contact__whatsapp" title="Chat on WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                    <span class="floating-contact__tooltip">WhatsApp</span>
                </a>
            @endif

            @if ($globalProfile->viber)
                <a href="viber://chat?number={{ preg_replace('/[^0-9]/', '', $globalProfile->viber) }}"
                    class="floating-contact__option floating-contact__viber" title="Chat on Viber">
                    <i class="fab fa-viber"></i>
                    <span class="floating-contact__tooltip">Viber</span>
                </a>
            @endif

            @if ($globalProfile->phone1)
                <a href="tel:{{ $globalProfile->phone1 }}" class="floating-contact__option floating-contact__phone"
                    title="Call Us">
                    <i class="fas fa-phone"></i>
                    <span class="floating-contact__tooltip">Call</span>
                </a>
            @endif
        </div>
    </div>

    <style>
        /* Floating Contact Styles */
        .floating-contact {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .floating-contact__main-btn {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
            overflow: hidden;
        }

        .floating-contact__main-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 50%;
        }

        .floating-contact__main-btn:hover::before {
            opacity: 1;
        }

        .floating-contact__main-btn i {
            font-size: 24px;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .floating-contact__close-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(90deg);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .floating-contact.active .floating-contact__main-btn i:first-child {
            transform: rotate(-90deg);
            opacity: 0;
        }

        .floating-contact.active .floating-contact__close-icon {
            transform: translate(-50%, -50%) rotate(0deg);
            opacity: 1;
        }

        .floating-contact__main-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .floating-contact__options {
            position: absolute;
            bottom: 80px;
            right: 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .floating-contact.active .floating-contact__options {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .floating-contact__option {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
            transform: scale(0);
            animation: none;
        }

        .floating-contact.active .floating-contact__option {
            transform: scale(1);
        }

        .floating-contact.active .floating-contact__option:nth-child(1) {
            animation: slideIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.1s forwards;
        }

        .floating-contact.active .floating-contact__option:nth-child(2) {
            animation: slideIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.2s forwards;
        }

        .floating-contact.active .floating-contact__option:nth-child(3) {
            animation: slideIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.3s forwards;
        }

        @keyframes slideIn {
            from {
                transform: scale(0) rotate(180deg);
                opacity: 0;
            }

            to {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }
        }

        .floating-contact__whatsapp {
            background: linear-gradient(135deg, #25D366, #128C7E);
        }

        .floating-contact__viber {
            background: linear-gradient(135deg, #665CAC, #7C3AED);
        }

        .floating-contact__phone {
            background: linear-gradient(135deg, #3B82F6, #1E40AF);
        }

        .floating-contact__option i {
            font-size: 20px;
            color: white;
            transition: all 0.3s ease;
        }

        .floating-contact__option:hover {
            transform: scale(1.15);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .floating-contact__option:hover i {
            transform: scale(1.1);
        }

        .floating-contact__tooltip {
            position: absolute;
            right: 60px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .floating-contact__tooltip::after {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 5px solid transparent;
            border-left-color: rgba(0, 0, 0, 0.8);
        }

        .floating-contact__option:hover .floating-contact__tooltip {
            opacity: 1;
            visibility: visible;
            transform: translateY(-50%) translateX(-5px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .floating-contact {
                bottom: 20px;
                right: 20px;
            }

            .floating-contact__main-btn {
                width: 55px;
                height: 55px;
            }

            .floating-contact__main-btn i {
                font-size: 22px;
            }

            .floating-contact__option {
                width: 45px;
                height: 45px;
            }

            .floating-contact__option i {
                font-size: 18px;
            }

            .floating-contact__options {
                bottom: 75px;
                gap: 12px;
            }

            .floating-contact__tooltip {
                display: none;
                /* Hide tooltips on mobile */
            }
        }

        @media (max-width: 480px) {
            .floating-contact {
                bottom: 15px;
                right: 15px;
            }

            .floating-contact__main-btn {
                width: 50px;
                height: 50px;
            }

            .floating-contact__main-btn i {
                font-size: 20px;
            }

            .floating-contact__option {
                width: 42px;
                height: 42px;
            }

            .floating-contact__option i {
                font-size: 16px;
            }

            .floating-contact__options {
                bottom: 65px;
                gap: 10px;
            }
        }

        /* Accessibility improvements */
        @media (prefers-reduced-motion: reduce) {

            .floating-contact__main-btn,
            .floating-contact__option,
            .floating-contact__options,
            .floating-contact__tooltip {
                transition: none;
                animation: none;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .floating-contact__tooltip {
                background: rgba(255, 255, 255, 0.9);
                color: #1a1a1a;
            }

            .floating-contact__tooltip::after {
                border-left-color: rgba(255, 255, 255, 0.9);
            }
        }

        /* Pulse animation for attention */
        .floating-contact__main-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50%;
            animation: pulse 2s infinite;
            background: inherit;
            z-index: -1;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.3;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contactToggle = document.getElementById('contactToggle');
            const floatingContact = document.getElementById('floating-contact');
            const contactOptions = document.getElementById('contactOptions');

            if (contactToggle && floatingContact) {
                contactToggle.addEventListener('click', function() {
                    floatingContact.classList.toggle('active');
                });

                // Close when clicking outside
                document.addEventListener('click', function(event) {
                    if (!floatingContact.contains(event.target)) {
                        floatingContact.classList.remove('active');
                    }
                });

                // Close on escape key
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        floatingContact.classList.remove('active');
                    }
                });

                // Prevent closing when clicking on the options
                if (contactOptions) {
                    contactOptions.addEventListener('click', function(event) {
                        event.stopPropagation();
                    });
                }
            }
        });
    </script>
@endif
