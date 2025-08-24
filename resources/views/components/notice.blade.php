{{-- Notice Section Component --}}
<section class="py-16 lg:py-24 bg-gradient-to-br from-primary/5 via-white to-secondary/5 relative overflow-hidden">
    {{-- Background Decorative Elements --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-10 right-20 w-40 h-40 bg-primary/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 left-10 w-32 h-32 bg-secondary/5 rounded-full blur-3xl animate-pulse delay-700"></div>
        <div class="absolute top-1/3 left-1/4 w-24 h-24 bg-accent/5 rounded-full blur-2xl animate-pulse delay-300"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-accent/10 text-accent px-4 py-2 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M13,9H18.5L13,3.5V9M6,2H14L20,8V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V4C4,2.89 4.89,2 6,2M15,18V16H6V18H15M18,14V12H6V14H18Z"/>
                </svg>
                Important Notices
            </div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                Latest
                <span class="text-primary">Updates & Announcements</span>
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-accent to-primary mx-auto rounded-full mb-6"></div>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Stay informed with the latest news, policy updates, and important announcements from our organization.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">
            {{-- Main Notice Board --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Featured Notice --}}
                <div class="bg-gradient-to-br from-red-50 via-white to-red-50 border border-red-100 rounded-2xl p-8 shadow-lg">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M13,14H11V10H13M13,18H11V16H13M1,21H23L12,2L1,21Z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">Urgent</span>
                                <span class="text-gray-500 text-sm">Posted 2 hours ago</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Important Deadline Extension: 2024 Research Grant Applications</h3>
                            <p class="text-gray-700 leading-relaxed mb-6">
                                Due to high demand, we are extending the deadline for 2024 Research Grant Applications to March 31st, 2024. This extension will allow more researchers to submit their proposals for groundbreaking plant breeding research projects. All applications must be submitted through the online portal with complete documentation.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <button class="bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600 transition-colors duration-300">
                                    Apply Now
                                </button>
                                <button class="border border-red-200 text-red-600 px-6 py-3 rounded-lg font-semibold hover:bg-red-50 transition-colors duration-300">
                                    Learn More
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Regular Notices --}}
                <div class="space-y-4">
                    <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">Policy Update</span>
                                    <span class="text-gray-500 text-sm">March 8, 2024</span>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">New Membership Benefits and Fee Structure 2024</h4>
                                <p class="text-gray-600 text-sm leading-relaxed mb-3">
                                    We are pleased to announce enhanced membership benefits including free access to premium research databases, priority conference registration, and reduced publication fees.
                                </p>
                                <button class="text-blue-600 hover:text-blue-800 font-medium text-sm hover:underline">
                                    Read Full Notice →
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Event</span>
                                    <span class="text-gray-500 text-sm">March 7, 2024</span>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Call for Papers: IPBO Annual Conference 2024</h4>
                                <p class="text-gray-600 text-sm leading-relaxed mb-3">
                                    Submit your research papers for the 2024 International Plant Breeding Organization Annual Conference. Deadline for abstract submission is April 15, 2024.
                                </p>
                                <button class="text-green-600 hover:text-green-800 font-medium text-sm hover:underline">
                                    Submit Paper →
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-semibold">Awards</span>
                                    <span class="text-gray-500 text-sm">March 5, 2024</span>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">2024 Excellence in Plant Breeding Award Nominations Open</h4>
                                <p class="text-gray-600 text-sm leading-relaxed mb-3">
                                    Nominations are now open for the prestigious Excellence in Plant Breeding Award 2024. Recognize outstanding contributions to the field by nominating deserving candidates.
                                </p>
                                <button class="text-purple-600 hover:text-purple-800 font-medium text-sm hover:underline">
                                    Nominate Now →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-8">
                {{-- Quick Announcements --}}
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10,20V14H14V20H19V12H22L12,3L2,12H5V20H10Z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Quick Updates</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <div class="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 mb-1">Website Maintenance</p>
                                <p class="text-xs text-gray-600">Scheduled for March 15, 2-4 AM UTC</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <div class="w-2 h-2 bg-secondary rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 mb-1">Journal Publication</p>
                                <p class="text-xs text-gray-600">March 2024 issue now available online</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <div class="w-2 h-2 bg-accent rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 mb-1">New Partnership</p>
                                <p class="text-xs text-gray-600">Collaboration with Global Seed Alliance</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Important Dates --}}
                <div class="bg-gradient-to-br from-primary/5 via-white to-secondary/5 border border-primary/10 rounded-2xl p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-gradient-to-br from-accent to-primary rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Important Dates</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Conference Abstract Deadline</p>
                                <p class="text-xs text-gray-600">Submit your research abstracts</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-primary">Apr 15</p>
                                <p class="text-xs text-gray-500">2024</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Membership Renewal</p>
                                <p class="text-xs text-gray-600">Annual membership due</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-secondary">May 1</p>
                                <p class="text-xs text-gray-500">2024</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Summer Workshop</p>
                                <p class="text-xs text-gray-600">Registration opens</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-accent">Jun 10</p>
                                <p class="text-xs text-gray-500">2024</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Newsletter Subscription --}}
                <div class="bg-gradient-to-br from-primary to-secondary rounded-2xl p-6 text-white">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/>
                        </svg>
                        <h3 class="text-lg font-bold">Stay Updated</h3>
                    </div>
                    <p class="text-sm opacity-90 mb-4">
                        Subscribe to our newsletter for the latest updates, research findings, and event announcements.
                    </p>
                    <div class="space-y-3">
                        <input type="email" placeholder="Enter your email" 
                               class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/70 focus:outline-none focus:bg-white/20 focus:border-white/40 transition-all duration-300">
                        <button class="w-full bg-white text-primary py-2 px-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-300">
                            Subscribe Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
