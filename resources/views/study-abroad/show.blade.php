@extends('layouts.app')

@section('head')
    <x-meta-tags :title="$studyAbroad->metatitle ?: $studyAbroad->title . ' - Study Abroad Program'" :description="$studyAbroad->metadescription ?: $studyAbroad->excerpt" :keywords="$studyAbroad->metakeywords" :image="$studyAbroad->feature_image_url" type="article" :post="$studyAbroad" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Procounsel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/procounsel.css') }}">

    @if ($studyAbroad->google_schema_json)
        <script type="application/ld+json">{!! $studyAbroad->google_schema_json !!}</script>
    @endif
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner :title="$studyAbroad->title" :breadcrumbs="[
        ['label' => 'Home', 'url' => url('/')],
        ['label' => 'Study Abroad', 'url' => route('study-abroad.index')],
        ['label' => $studyAbroad->title],
    ]" />

    <!-- Main Content Section -->
    <section class="pt-0">
        <div class="px-3">
            <div class="flex flex-wrap -mx-4">
                <!-- Sidebar - Table of Contents (Hidden on Mobile) -->
                <div class="w-full lg:w-1/4 px-4 hidden lg:block">
                    @if ($tableOfContents->count() > 0)
                        <!-- Table of Contents Navigation -->
                        <div class="sticky top-[5rem] z-50 transition-all duration-300" id="tocSidebar">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden toc-navigation max-h-[calc(100vh-7rem)] border border-gray-200">
                                <div class="bg-gradient-to-r from-primary to-secondary text-white p-5">
                                    <h5 class="mb-0 flex items-center text-base font-medium text-gray-50">
                                        <i class="fas fa-list-ol mr-2"></i>
                                        Program Contents
                                    </h5>
                                </div>
                                <div class="p-0">
                                    <nav class="toc-nav max-h-[calc(100vh-15rem)] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                                        @foreach ($tableOfContents as $content)
                                            <a href="#toc-section-{{ $content->id }}"
                                                class="toc-nav-link flex items-center no-underline p-3 border-b border-gray-100 text-gray-700 hover:bg-primary hover:text-white transition-all duration-300 border-l-4 border-l-transparent hover:border-l-white text-sm group"
                                                data-target="toc-section-{{ $content->id }}">
                                                <span class="flex-1 group-hover:pl-1 transition-all duration-300">{{ Str::limit($content->title, 100) }}</span>
                                                <i class="fas fa-chevron-right opacity-0 group-hover:opacity-100 ml-2 transform scale-75 group-hover:scale-100 transition-all duration-300"></i>
                                            </a>
                                        @endforeach
                                    </nav>
                                </div>
                            </div>
                            
                            <!-- Progress Indicator -->
                            <div class="mt-4 bg-white rounded-lg shadow-sm p-3 border border-gray-200">
                                <div class="flex items-center text-xs text-gray-600">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Reading Progress</span>
                                </div>
                                <div class="mt-2 bg-gray-200 rounded-full h-2">
                                    <div id="reading-progress" class="bg-gradient-to-r from-primary to-secondary h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Main Content (Full width on mobile, 3/4 on desktop) -->
                <div class="w-full lg:w-3/4 px-4">
                    <!-- Program Header -->
                    <div class="publication-header-card bg-white overflow-hidden">
                        @if ($studyAbroad->feature_image_url)
                            <div class="publication-image-wrapper">
                                <img src="{{ $studyAbroad->feature_image_url }}" alt="{{ $studyAbroad->title }}"
                                    class="w-full h-96 object-cover publication-feature-image">
                            </div>
                        @endif
                        <div class="p-6">
                            <!-- Program Type Badge -->
                            <div class="mb-4">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-plane mr-2"></i>
                                    Study Abroad Program
                                </span>
                            </div>
                            
                            <h2 class="publication-summary-title text-3xl md:text-4xl font-normal text-gray-900 mb-4">
                                {{ $studyAbroad->title }}</h2>
                            @if ($studyAbroad->description)
                                <div class="publication-content text-gray-700 leading-relaxed">
                                    {!! $studyAbroad->description !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Table of Contents Content Sections -->
                    @if ($tableOfContents->count() > 0)
                        @foreach ($tableOfContents as $content)
                            <section id="toc-section-{{ $content->id }}" class="bg-white toc-content-section">
                                <div class="p-6 md:p-8">
                                    <div class="flex items-start mb-4">
                                        <div class="flex-1">
                                            <h3 class="content-title text-2xl md:text-3xl font-normal text-gray-900 mb-4">
                                                {{ $content->title }}</h3>
                                            @if ($content->description)
                                                <div class="toc-content text-gray-700 leading-relaxed">
                                                    {!! $content->description !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endforeach
                    @endif

                    <!-- Team Members Section -->
                    @if (!empty($teamMembers) && count($teamMembers) > 0)
                        <section id="team-section"
                            class="modern-team-section py-4 bg-gray-100 relative overflow-hidden mt-10 rounded-lg">
                            <!-- Section Header -->
                            <div class="mb-8 px-3">
                                <h3 class="text-2xl font-bold text-accent mb-4">
                                    <i class="fas fa-users mr-3 text-primary"></i>
                                    Program Advisors & Support Team
                                </h3>
                            </div>

                            <div class="container mx-auto px-4 relative z-10">
                                <!-- Team Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-16 gap-y-4 mb-12">
                                    @foreach ($teamMembers as $index => $member)
                                        <div class="team-card-wrapper w-[14rem]" data-aos="fade-up" data-aos-duration="800"
                                            data-aos-delay="{{ $index * 100 }}">
                                            <div
                                                class="bg-white rounded-2xl shadow-md transition-all duration-500 group overflow-hidden border border-gray-100 hover:border-primary/30">
                                                <!-- Team Member Image -->
                                                @if (isset($member['slug']) && $member['slug'])
                                                    <a href="{{ route('team.show', $member['slug']) }}" class="block">
                                                    @else
                                                        <div class="block">
                                                @endif
                                                <div class="relative overflow-hidden">
                                                    <div class="bg-gradient-to-br from-accent to-secondary/20">
                                                        @if (isset($member['image_url']) && $member['image_url'])
                                                            <img src="{{ $member['image_url'] }}"
                                                                alt="{{ $member['name'] ?? 'Team Member' }}"
                                                                class="w-full h-[18rem] object-cover object-center">
                                                        @else
                                                            <img src="{{ asset('assets/images/team/team-1-1.jpg') }}"
                                                                alt="{{ $member['name'] ?? 'Team Member' }}"
                                                                class="w-full h-[18rem] object-cover transition-transform duration-700 ease-out">
                                                        @endif
                                                    </div>
                                                </div>
                                                @if (isset($member['slug']) && $member['slug'])
                                                    </a>
                                                @else
                                            </div>
                    @endif

                    <!-- Team Member Info -->
                    <div class="px-4 py-2">
                        <h3
                            class="font-medium text-lg text-gray-900 group-hover:text-primary transition-colors duration-300">
                            @if (isset($member['slug']) && $member['slug'])
                                <a href="{{ route('team.show', $member['slug']) }}" class="text-primary">
                                    {{ $member['name'] ?? 'Team Member' }}
                                </a>
                            @else
                                <span class="text-primary">{{ $member['name'] ?? 'Team Member' }}</span>
                            @endif
                        </h3>
                        <p class="text-gray-600 font-normal text-sm mb-2">
                            {{ $member['designation'] ?? 'Program Advisor' }}
                        </p>

                        <!-- Contact Info -->
                        <div class="space-y-2 text-xs text-gray-500">
                            @if (isset($member['phone']) && $member['phone'])
                                <div class="flex space-x-2">
                                    <i class="fas fa-phone text-primary"></i>
                                    <a href="tel:{{ $member['phone'] }}"
                                        class="hover:text-primary transition-colors duration-300">
                                        {{ $member['phone'] }}
                                    </a>
                                </div>
                            @endif
                            @if (isset($member['email']) && $member['email'])
                                <div class="flex space-x-2">
                                    <i class="fas fa-envelope text-primary"></i>
                                    <a href="mailto:{{ $member['email'] }}"
                                        class="hover:text-primary transition-colors duration-300">
                                        {{ $member['email'] }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Social Media Icons (Footer) -->
                        <div class="flex justify-between space-x-3 mt-2 pt-2 border-t border-gray-100">
                            <div class="flex space-x-3 w-[50%]">
                                @if (isset($member['facebooklink']) && $member['facebooklink'])
                                    <a href="{{ $member['facebooklink'] }}" target="_blank"
                                        class="w-8 h-8 bg-accent rounded-full flex items-center justify-center text-white hover:bg-primary hover:text-white transition-all duration-300">
                                        <i class="fab fa-facebook-f text-xs"></i>
                                    </a>
                                @endif
                                @if (isset($member['linkedinlink']) && $member['linkedinlink'])
                                    <a href="{{ $member['linkedinlink'] }}" target="_blank"
                                        class="w-8 h-8 bg-accent rounded-full flex items-center justify-center text-white hover:bg-secondary hover:text-white transition-all duration-300">
                                        <i class="fab fa-linkedin-in text-xs"></i>
                                    </a>
                                @endif
                            </div>
                            @if (isset($member['slug']) && $member['slug'])
                                <a href="{{ route('team.show', $member['slug']) }}"
                                    class="px-2 py-2 bg-accent text-white text-xs font-semibold rounded-lg hover:bg-secondary transition-all duration-300 hover:scale-105">
                                    View more
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-accent rounded-full blur-3xl opacity-60 animate-pulse"></div>
        <div
            class="absolute bottom-10 right-10 w-32 h-32 bg-primary/20 rounded-full blur-3xl opacity-40 animate-pulse delay-1000">
        </div>
        </section>
        @endif

        <!-- FAQs Section -->
        @if ($faqs->count() > 0)
            <section id="faqs-section" class="bg-white rounded-lg shadow-lg faq-section">
                <div class="text-accent p-5 rounded-t-lg">
                    <h3 class="mb-0 text-2xl font-bold">
                        <i class="fas fa-question-circle mr-2"></i>
                        Frequently Asked Questions
                    </h3>
                </div>
                <div class="p-6 md:p-8">
                    <div class="space-y-4" id="faqAccordion">
                        @foreach ($faqs as $faq)
                            <div class="border border-gray-200 rounded-lg overflow-hidden mb-3">
                                <h6 class="" id="faq-heading-{{ $faq->id }}">
                                    <button
                                        class="w-full text-left p-5 bg-white hover:bg-gray-50 flex items-center font-medium text-gray-900 faq-toggle transition-colors duration-200"
                                        type="button" onclick="toggleFaq('faq-{{ $faq->id }}')" aria-expanded="false"
                                        aria-controls="faq-{{ $faq->id }}">
                                        <i class="fas fa-question-circle mr-3 text-accent"></i>
                                        {{ $faq->question }}
                                        <i class="fas fa-chevron-down ml-auto transform transition-transform duration-200"
                                            id="chevron-{{ $faq->id }}"></i>
                                    </button>
                                </h6>
                                <div id="faq-{{ $faq->id }}" class="hidden"
                                    aria-labelledby="faq-heading-{{ $faq->id }}">
                                    <div class="p-5 bg-gray-100 text-gray-700 leading-relaxed">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Quick Legal Assistance Section -->
        <section class="bg-accent rounded-lg shadow-xl overflow-hidden cta-section mt-10 p-6">
            @php
                // Use globalProfile for contact info like in contact-section.blade.php
                $phoneNumbers = [];
                if ($globalProfile) {
                    $phoneNumbers = array_filter([
                        $globalProfile->phone1 ?? null,
                        $globalProfile->phone2 ?? null,
                    ]);
                }
                $primaryPhone = !empty($phoneNumbers) ? $phoneNumbers[0] : null;
                $emailAddress = $globalProfile->email ?? null;
                
                // Clean phone number for links (remove any formatting)
                $cleanPhone = $primaryPhone ? preg_replace('/[^0-9+]/', '', $primaryPhone) : null;
            @endphp
            
            <div class="text-left">
                <h3 class="text-xl font-bold text-white mb-3 underline decoration-white">
                    Need guidance for your study abroad journey?
                </h3>
                
                <div class="text-white text-base mb-4">
                    @if ($primaryPhone)
                        <p class="mb-2">
                            <span class="font-medium">You can directly call to our study abroad advisor:</span> 
                            <a href="tel:{{ $cleanPhone }}" class="font-bold hover:underline">{{ $primaryPhone }}</a>
                        </p>
                    @endif
                    <p class="mb-4">
                        <span class="font-medium">Even can call or drop a text through What's app , Viber, Telegram and We Chat at the same number.</span>
                    </p>
                </div>

                <!-- Messaging App Icons -->
                <div class="flex items-center gap-3 mb-4">
                    @if ($globalProfile && $globalProfile->whatsapp)
                        <a href="{{ $globalProfile->whatsapp }}" target="_blank" class="bg-white p-3 rounded-lg hover:scale-105 transition-transform duration-200">
                            <i class="fab fa-whatsapp text-green-500 text-2xl"></i>
                        </a>
                    @elseif ($cleanPhone)
                        <a href="https://wa.me/{{ ltrim($cleanPhone, '+') }}" target="_blank" class="bg-white p-3 rounded-lg hover:scale-105 transition-transform duration-200">
                            <i class="fab fa-whatsapp text-green-500 text-2xl"></i>
                        </a>
                    @endif
                    
                    @if ($globalProfile && $globalProfile->viber)
                        <a href="{{ $globalProfile->viber }}" target="_blank" class="bg-white p-3 rounded-lg hover:scale-105 transition-transform duration-200">
                            <i class="fab fa-viber text-purple-600 text-2xl"></i>
                        </a>
                    @elseif ($cleanPhone)
                        <a href="viber://chat?number={{ $cleanPhone }}" target="_blank" class="bg-white p-3 rounded-lg hover:scale-105 transition-transform duration-200">
                            <i class="fab fa-viber text-purple-600 text-2xl"></i>
                        </a>
                    @endif
                    
                    @if ($cleanPhone)
                        <a href="https://t.me/{{ ltrim($cleanPhone, '+') }}" target="_blank" class="bg-white p-3 rounded-lg hover:scale-105 transition-transform duration-200">
                            <i class="fab fa-telegram text-blue-500 text-2xl"></i>
                        </a>
                    @endif
                </div>

                @if ($emailAddress)
                    <div class="text-white text-base">
                        <p class="mb-2">
                            <span class="font-medium">Also can do email on :</span> 
                            <a href="mailto:{{ $emailAddress }}" class="font-bold hover:underline text-white">{{ $emailAddress }}</a>
                            @if ($globalProfile && $globalProfile->email2)
                                , <a href="mailto:{{ $globalProfile->email2 }}" class="font-bold hover:underline text-white">{{ $globalProfile->email2 }}</a>
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </section>

        <x-contact-section />
        </div>
        </div>
    </section>
    
    <!-- Related Programs Section -->
    @if($relatedStudyAbroad->count() > 0)
        <x-page-section-title title="<span>Related Study Abroad Programs</span>" />
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedStudyAbroad->take(4) as $related)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            @if($related->feature_image_url)
                                <div class="h-48 bg-gray-200 overflow-hidden">
                                    <img src="{{ $related->feature_image_url }}" 
                                        alt="{{ $related->title }}" 
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                            @endif
                            
                            <div class="p-4">
                                <div class="flex items-center mb-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-plane mr-1"></i>
                                        Study Abroad
                                    </span>
                                </div>
                                
                                <h4 class="text-lg font-bold text-gray-900 mb-2 hover:text-primary transition-colors">
                                    <a href="{{ route('study-abroad.show', $related->slug) }}">
                                        {{ Str::limit($related->title, 60) }}
                                    </a>
                                </h4>
                                
                                @if($related->excerpt)
                                    <p class="text-gray-600 text-sm mb-3">
                                        {{ Str::limit($related->excerpt, 100) }}
                                    </p>
                                @endif
                                
                                <a href="{{ route('study-abroad.show', $related->slug) }}" 
                                    class="inline-flex items-center text-primary hover:text-primary-dark font-medium text-sm">
                                    Learn More
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <!-- Custom JavaScript for FAQ toggle -->
    <script>
        function toggleFaq(faqId) {
            const faq = document.getElementById(faqId);
            const chevron = document.getElementById('chevron-' + faqId.replace('faq-', ''));

            if (faq.classList.contains('hidden')) {
                faq.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                faq.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth Scrolling for TOC Links
            const tocLinks = document.querySelectorAll('.toc-nav-link');
            const sections = document.querySelectorAll('[id^="toc-section-"], #team-section, #faqs-section');

            tocLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('data-target') || this.getAttribute('href')
                        .substring(1);
                    const targetSection = document.getElementById(targetId);

                    if (targetSection) {
                        // Remove active state from all links
                        tocLinks.forEach(l => {
                            l.classList.remove('toc-nav-active');
                        });

                        // Add active state to clicked link
                        this.classList.add('toc-nav-active');

                        // Smooth scroll to section with offset for fixed header
                        const headerOffset = 100;
                        const elementPosition = targetSection.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });

                        // Hide mobile TOC after clicking
                        if (window.innerWidth < 992) {
                            const collapse = bootstrap.Collapse.getInstance(document.getElementById(
                                'tocNavigation'));
                            if (collapse) {
                                collapse.hide();
                            }
                        }
                    }
                });
            });

            // Intersection Observer for Active TOC Item
            const observerOptions = {
                root: null,
                rootMargin: '-20% 0px -70% 0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Remove active state from all links
                        tocLinks.forEach(link => {
                            link.classList.remove('toc-nav-active');
                        });

                        // Find and activate corresponding TOC link
                        const correspondingLink = document.querySelector(
                            `[data-target="${entry.target.id}"], [href="#${entry.target.id}"]`);
                        if (correspondingLink) {
                            correspondingLink.classList.add('toc-nav-active');
                        }
                    }
                });
            }, observerOptions);

            // Observe all sections
            sections.forEach(section => {
                observer.observe(section);
            });

            // Enhanced active state management for TOC
            const enhancedObserver = new IntersectionObserver(function(entries) {
                let mostVisibleEntry = null;
                let maxIntersectionRatio = 0;

                entries.forEach(entry => {
                    if (entry.isIntersecting && entry.intersectionRatio > maxIntersectionRatio) {
                        maxIntersectionRatio = entry.intersectionRatio;
                        mostVisibleEntry = entry;
                    }
                });

                if (mostVisibleEntry) {
                    // Remove active state from all links
                    tocLinks.forEach(link => {
                        link.classList.remove('toc-nav-active', 'bg-primary', 'text-white',
                            'border-l-primary');
                        link.classList.add('border-l-transparent', 'text-gray-700');
                    });

                    // Find and activate corresponding TOC link
                    const correspondingLink = document.querySelector(
                        `[data-target="${mostVisibleEntry.target.id}"], [href="#${mostVisibleEntry.target.id}"]`
                    );
                    if (correspondingLink) {
                        correspondingLink.classList.add('toc-nav-active', 'bg-primary', 'text-white',
                            'border-l-primary');
                        correspondingLink.classList.remove('border-l-transparent', 'text-gray-700');
                    }
                }
            }, {
                root: null,
                rootMargin: '-20% 0px -60% 0px',
                threshold: [0.1, 0.5, 1.0]
            });

            // Observe all sections
            sections.forEach(section => {
                enhancedObserver.observe(section);
            });

            // Enhanced TOC link click handling
            tocLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('data-target') || this.getAttribute('href')
                        .substring(1);
                    const targetSection = document.getElementById(targetId);

                    if (targetSection) {
                        // Remove active state from all links
                        tocLinks.forEach(l => {
                            l.classList.remove('toc-nav-active', 'bg-primary', 'text-white',
                                'border-l-primary');
                            l.classList.add('border-l-transparent', 'text-gray-700');
                        });

                        // Add active state to clicked link
                        this.classList.add('toc-nav-active', 'bg-primary', 'text-white',
                            'border-l-primary');
                        this.classList.remove('border-l-transparent', 'text-gray-700');

                        // Calculate scroll position
                        const headerOffset = 120;
                        const elementPosition = targetSection.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        // Smooth scroll
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Reading Progress Functionality
            function updateReadingProgress() {
                const windowHeight = window.innerHeight;
                const documentHeight = document.documentElement.scrollHeight - windowHeight;
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const progress = (scrollTop / documentHeight) * 100;
                
                const progressBar = document.getElementById('reading-progress');
                if (progressBar) {
                    progressBar.style.width = Math.min(progress, 100) + '%';
                }
            }
            
            // Enhanced Sticky Sidebar Behavior
            function handleStickyElem() {
                const tocSidebar = document.getElementById('tocSidebar');
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (tocSidebar) {
                    if (scrollTop > 100) {
                        tocSidebar.classList.add('scrolled');
                    } else {
                        tocSidebar.classList.remove('scrolled');
                    }
                }
            }
            
            // Add scroll event listeners
            let ticking = false;
            function requestTick() {
                if (!ticking) {
                    requestAnimationFrame(function() {
                        updateReadingProgress();
                        handleStickyElem();
                        ticking = false;
                    });
                    ticking = true;
                }
            }
            
            window.addEventListener('scroll', requestTick);
            window.addEventListener('resize', requestTick);
            
            // Initial call
            updateReadingProgress();
            handleStickyElem();
        });
    </script>
@endpush

@push('styles')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: var(--procounsel-base);
            color: #fff;
            font-weight: 600;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Enhanced Sticky Sidebar Styles */
        #tocSidebar {
            transition: all 0.3s ease;
        }
        
        #tocSidebar.scrolled {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Custom Scrollbar for Sidebar */
        .toc-nav::-webkit-scrollbar {
            width: 4px;
        }
        
        .toc-nav::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }
        
        .toc-nav::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }
        
        .toc-nav::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Active TOC Link Styling */
        .toc-nav-link.toc-nav-active {
            background: linear-gradient(135deg, var(--tw-gradient-stops));
            --tw-gradient-from: rgb(var(--color-primary));
            --tw-gradient-to: rgb(var(--color-secondary));
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            transform: translateX(2px);
            box-shadow: inset 4px 0 0 white;
        }
        
        /* Smooth animations for sidebar elements */
        .toc-nav-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Reading progress animation */
        #reading-progress {
            transition: width 0.1s ease-out;
        }
        
        /* Responsive behavior */
        @media (max-width: 1024px) {
            #tocSidebar {
                position: relative !important;
                top: auto !important;
            }
        }

        @media (max-width: 768px) {
            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
                width: 100%;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 6px;
                padding: 10px;
                background-color: #fff;
            }

            td {
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: 600;
                color: #2c3e50;
                text-align: left;
            }
        }
    </style>
@endpush
