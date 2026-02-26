@extends('layouts.app')

@section('meta_tags')
    <x-detail-meta-tags :post="$team" />
@endsection

@section('head')
    <style>
        .team-des-wrapper h2 {}

        .team-des-wrapper h3 {
            font-size: 20px;
            font-weight: 500;
        }

        .team-des-wrapper h4 {}

        .team-des-wrapper p {}

        .team-des-wrapper ol,
        .team-des-wrapper ul {
            list-style-type: disc;
            margin-left: 20px;
        }

        .team-des-wrapper table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            margin: 20px 0;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .team-des-wrapper thead tr th {
            background-color: #2b4c7e;
            color: #fff;
            text-align: left;
            padding: 12px;
            font-size: 16px;
        }

        .team-des-wrapper tbody tr td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            vertical-align: top;
            font-size: 15px;
            color: #333;
        }

        .team-des-wrapper tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .team-des-wrapper tbody tr:hover {
            background-color: #f1f5ff;
            transition: 0.2s;
        }

        /* Optional scroll for mobile */
        .team-des-wrapper div {
            overflow-x: auto;
        }
    </style>
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner :title="$team->name" :subtitle="$team->tagline" :breadcrumbs="[
        ['label' => 'Home', 'url' => url('/')],
        ['label' => 'Our Team', 'url' => route('team.index')],
        ['label' => $team->name],
    ]" />

    {{-- Main Content Section --}}
    <section class="py-16 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 1px 1px, rgba(59, 130, 246, 0.3) 1px, transparent 0); background-size: 30px 30px;">
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content - 70% -->
                <div class="lg:col-span-2">
                    <!-- Team Member Profile Card -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-8 group">
                        <!-- Profile Header with Gradient Background -->
                        <div class="relative bg-gradient-to-br from-primary via-primary to-primary p-8">
                            <!-- Decorative Elements -->
                            <div class="absolute top-4 right-4 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
                            <div class="absolute bottom-4 right-12 w-12 h-12 bg-white/20 rounded-full blur-lg"></div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center relative z-10">
                                <!-- Profile Image -->
                                <div class="text-center md:text-left">
                                    <div class="relative inline-block">
                                        @if ($team->image_url)
                                            <img src="{{ $team->image_url }}" alt="{{ $team->image_alt ?: $team->name }}"
                                                class="w-32 h-48 md:w-40 md:h-56 object-fill rounded-2xl border-4 border-white/30 shadow-2xl group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div
                                                class="w-32 h-40 md:w-40 md:h-48 bg-white/20 backdrop-blur-sm rounded-2xl border-4 border-white/30 flex items-center justify-center shadow-2xl group-hover:scale-105 transition-transform duration-300">
                                                <i class="fas fa-user text-white text-6xl"></i>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                <!-- Profile Info -->
                                <div class="md:col-span-2 text-center md:text-left">
                                    <h1
                                        class="text-3xl md:text-4xl font-bold text-white mb-2 group-hover:text-white/90 transition-colors">
                                        {{ $team->name }}</h1>
                                    <h3 class="text-xl md:text-2xl text-white/90 font-semibold mb-4">
                                        {{ $team->designation }}</h3>

                                    @if ($team->tagline)
                                        <p class="text-white/80 text-lg mb-6 leading-relaxed">{{ $team->tagline }}</p>
                                    @endif

                                    <!-- Quick Contact Buttons -->
                                    <div class="flex flex-wrap justify-center md:justify-start gap-3">
                                        @if ($team->email)
                                            <a href="mailto:{{ $team->email }}"
                                                class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-white hover:text-primary transition-all duration-300 hover:scale-105">
                                                <i class="fas fa-envelope"></i> Email
                                            </a>
                                        @endif
                                        @if ($team->phone)
                                            <a href="tel:{{ $team->phone }}" rel="nofollow"
                                                class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-green-500 hover:text-white transition-all duration-300 hover:scale-105">
                                                <i class="fas fa-phone"></i> Call
                                            </a>
                                        @endif
                                        @if ($team->linkedinlink)
                                            <a href="{{ $team->linkedinlink }}" target="_blank"
                                                class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-primary hover:text-white transition-all duration-300 hover:scale-105">
                                                <i class="fab fa-linkedin-in"></i> LinkedIn
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biography Section -->
                    @if ($team->description)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
                            <h3 class="flex items-center gap-4 text-2xl font-bold text-primary mb-6">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-primary to-primary rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user-circle text-white text-xl"></i>
                                </div>
                                About {{ $team->name }}
                            </h3>
                            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed team-des-wrapper">
                                {!! $team->description !!}
                            </div>
                        </div>
                    @endif

                    <!-- Professional Profile Section -->
                    {{-- <div
                        class="bg-gradient-to-br from-gray-50 to-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
                        <h3 class="flex items-center gap-4 text-2xl font-bold text-primary mb-8">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-primary to-primary rounded-xl flex items-center justify-center">
                                <i class="fas fa-briefcase text-white text-xl"></i>
                            </div>
                            Professional Profile
                        </h3>

                        <!-- Tab Navigation -->
                        <div class="flex flex-wrap border-b border-gray-200 mb-6" role="tablist">
                            @if ($team->experience)
                                <button
                                    class="tab-button flex items-center gap-2 px-6 py-3 text-sm font-semibold text-gray-500 hover:text-primary border-b-2 border-transparent hover:border-primary transition-all duration-300 active"
                                    onclick="switchTab(event, 'experience-tab')" role="tab"
                                    aria-controls="experience-tab" aria-selected="true">
                                    <div class="w-6 h-6 bg-green-500 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-clock text-white text-xs"></i>
                                    </div>
                                    Experience
                                </button>
                            @endif

                            @if ($team->qualification)
                                <button
                                    class="tab-button flex items-center gap-2 px-6 py-3 text-sm font-semibold text-gray-500 hover:text-primary border-b-2 border-transparent hover:border-primary transition-all duration-300 {{ !$team->experience ? 'active' : '' }}"
                                    onclick="switchTab(event, 'education-tab')" role="tab" aria-controls="education-tab"
                                    aria-selected="{{ !$team->experience ? 'true' : 'false' }}">
                                    <div class="w-6 h-6 bg-purple-500 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-graduation-cap text-white text-xs"></i>
                                    </div>
                                    Qualification
                                </button>
                            @endif

                            @if ($team->additional_details)
                                <button
                                    class="tab-button flex items-center gap-2 px-6 py-3 text-sm font-semibold text-gray-500 hover:text-primary border-b-2 border-transparent hover:border-primary transition-all duration-300 {{ !$team->experience && !$team->qualification ? 'active' : '' }}"
                                    onclick="switchTab(event, 'additional-tab')" role="tab"
                                    aria-controls="additional-tab"
                                    aria-selected="{{ !$team->experience && !$team->qualification ? 'true' : 'false' }}">
                                    <div class="w-6 h-6 bg-blue-500 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-info-circle text-white text-xs"></i>
                                    </div>
                                    Additional Details
                                </button>
                            @endif
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            @if ($team->experience)
                                <div id="experience-tab" class="tab-panel active" role="tabpanel"
                                    aria-labelledby="experience-tab">
                                    <div class="bg-white rounded-xl p-8 shadow-md border border-gray-100">
                                        <div class="flex items-start gap-6">
                                            <div
                                                class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-clock text-white text-xl"></i>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="text-2xl font-bold text-gray-900 mb-4">Experience</h4>
                                                <p class="text-gray-600 text-lg leading-relaxed mb-4">
                                                    {{ $team->experience }}+ years of legal practice</p>
                                                <p class="text-gray-500 text-sm">With over {{ $team->experience }} years in
                                                    the legal field, {{ $team->name }} brings extensive experience and
                                                    deep knowledge to every case, ensuring clients receive the highest
                                                    quality legal representation.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($team->qualification)
                                <div id="education-tab" class="tab-panel {{ !$team->experience ? 'active' : '' }}"
                                    role="tabpanel" aria-labelledby="education-tab">
                                    <div class="bg-white rounded-xl p-8 shadow-md border border-gray-100">
                                        <div class="flex items-start gap-6">
                                            <div
                                                class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-graduation-cap text-white text-xl"></i>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="text-2xl font-bold text-gray-900 mb-4">Qualification</h4>
                                                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                                    {!! $team->qualification !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($team->additional_details)
                                <div id="additional-tab"
                                    class="tab-panel {{ !$team->experience && !$team->qualification ? 'active' : '' }}"
                                    role="tabpanel" aria-labelledby="additional-tab">
                                    <div class="bg-white rounded-xl p-8 shadow-md border border-gray-100">
                                        <div class="flex items-start gap-6">
                                            <div
                                                class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-info-circle text-white text-xl"></i>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="text-2xl font-bold text-gray-900 mb-4">Additional Details</h4>
                                                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                                    {!! $team->additional_details !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div> --}}
                </div>

                <!-- Sidebar - 30% -->
                <div class="lg:col-span-1">
                    <div class="sticky top-8 space-y-6">
                        <!-- Other Team Members -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                            <h4 class="flex items-center gap-3 text-xl font-bold text-primary mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-primary to-primary rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-white text-sm"></i>
                                </div>
                                Our Team
                            </h4>
                            <div class="space-y-4">
                                @php
                                    $otherTeamMembers = App\Models\Team::active()
                                        ->where('id', '!=', $team->id)
                                        ->ordered()
                                        ->take(4)
                                        ->get();
                                @endphp
                                @if ($otherTeamMembers->count() > 0)
                                    @foreach ($otherTeamMembers as $member)
                                        <div
                                            class="group flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-all duration-300 border-l-4 border-transparent hover:border-blue-500">
                                            <div class="relative flex-shrink-0">
                                                @if ($member->image_url)
                                                    <img src="{{ $member->image_url }}" alt="{{ $member->image_alt ?: $member->name }}"
                                                        class="w-20 h-28 rounded object-cover border-2 border-gray-100 group-hover:border-blue-300 transition-colors">
                                                @else
                                                    <div
                                                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center border-2 border-gray-100 group-hover:border-blue-300 transition-colors">
                                                        <i class="fas fa-user text-white text-lg"></i>
                                                    </div>
                                                @endif
                                                <div
                                                    class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white">
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h6
                                                    class="font-semibold text-gray-900 text-sm truncate group-hover:text-blue-600 transition-colors">
                                                    <a href="{{ route('team.show', $member) }}">{{ $member->name }}</a>
                                                </h6>
                                                <p class="text-gray-600 text-xs mt-1 truncate">{{ $member->designation }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-8 text-gray-500">
                                        <i class="fas fa-users text-3xl mb-3"></i>
                                        <p>No other team members available</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Social Share -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                            <h4 class="flex items-start gap-3 text-xl font-bold text-primary mb-6">
                                Share Profile
                            </h4>
                            <div class="flex justify-center gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank"
                                    class="w-12 h-12 bg-blue-600 hover:bg-blue-700 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode('Meet ' . $team->name . ' - ' . $team->designation) }}"
                                    target="_blank"
                                    class="w-12 h-12 bg-sky-500 hover:bg-sky-600 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                    target="_blank"
                                    class="w-12 h-12 bg-blue-800 hover:bg-blue-900 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode('Meet ' . $team->name . ' - ' . $team->designation . ' - ' . request()->url()) }}"
                                    target="_blank"
                                    class="w-12 h-12 bg-green-500 hover:bg-green-600 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Contact Form -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                            <h4 class="flex items-center gap-3 text-xl font-bold text-primary mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-primary to-primary rounded-lg flex items-center justify-center">
                                    <i class="fas fa-envelope text-white text-sm"></i>
                                </div>
                                Contact {{ $team->name }}
                            </h4>
                            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="fullname" class="block text-sm font-semibold text-gray-700 mb-2">Full Name
                                        *</label>
                                    <input type="text" id="fullname" name="fullname" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                        placeholder="Enter your full name">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email
                                        *</label>
                                    <input type="email" id="email" name="email" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                        placeholder="Enter your email">
                                </div>

                                <div>
                                    <label for="phone"
                                        class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                                    <input type="tel" id="phone" name="phone"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                        placeholder="Enter your phone number">
                                </div>

                                <div>
                                    <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject
                                        *</label>
                                    <input type="text" id="subject" name="subject" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                        placeholder="Enter subject" value="Consultation request for {{ $team->name }}">
                                </div>

                                <div>
                                    <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message
                                        *</label>
                                    <textarea id="message" name="message" rows="4" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors resize-none"
                                        placeholder="Write your message here..."></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-primary hover:from-primary hover:to-primary hover:opacity-90 text-white px-6 py-4 rounded-xl font-semibold hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-paper-plane"></i>
                                    Send Message
                                </button>
                            </form>
                        </div>

                        <!-- Back to Team -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 text-center">
                            <a href="{{ route('team.index') }}"
                                class="inline-flex items-center gap-3 px-6 py-3 border-2 border-primary text-primary hover:bg-primary hover:text-white rounded-xl font-semibold hover:scale-105 transition-all duration-300">
                                <i class="fas fa-arrow-left"></i>
                                View All Team Members
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Team Details Page Styles */
        .team-details-section {
            padding: 60px 0;
            background-color: var(--procounsel-gray);
            font-family: var(--procounsel-font);
        }

        .team-content-card {
            background: var(--procounsel-white);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 30px;
            border: 1px solid var(--procounsel-border-color);
        }

        .team-header {
            margin-bottom: 30px;
        }

        .team-image {
            position: relative;
        }

        .team-image img {
            width: 200px;
            height: 340px;
            object-fit: cover;
            border-radius: 15px;
            border: 4px solid var(--procounsel-border-color);
            transition: transform 0.3s ease;
        }

        .team-image:hover img {
            transform: scale(1.05);
        }

        .placeholder-avatar {
            width: 200px;
            height: 250px;
            background: linear-gradient(135deg, var(--procounsel-base), var(--procounsel-primary));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid var(--procounsel-border-color);
        }

        .placeholder-avatar i {
            color: var(--procounsel-white);
            font-size: 4rem;
        }

        .team-name {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .team-designation {
            color: var(--procounsel-base);
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .team-tagline {
            color: var(--procounsel-text);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .team-contact-buttons .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .team-contact-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Biography Section */
        .team-bio-section {
            background: var(--procounsel-white);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--procounsel-border-color);
        }

        .bio-title {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .bio-title i {
            color: var(--procounsel-base);
        }

        .team-description {
            color: var(--procounsel-text-dark);
            line-height: 1.7;
            font-size: 1rem;
        }

        .team-description h2,
        .team-description h3,
        .team-description h4 {
            color: var(--procounsel-primary);
            font-family: var(--procounsel-heading-font);
            margin-top: 25px;
            margin-bottom: 15px;
        }

        .team-description p {
            margin-bottom: 15px;
        }

        .team-description ul,
        .team-description ol {
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .team-description li {
            margin-bottom: 8px;
        }

        .team-description a {
            color: var(--procounsel-base);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .team-description a:hover {
            color: var(--procounsel-primary);
        }

        /* Professional Section */
        .professional-section {
            background: linear-gradient(135deg, var(--procounsel-gray) 0%, var(--procounsel-white) 100%);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            border: 1px solid var(--procounsel-border-color);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .professional-title {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .professional-title i {
            color: var(--procounsel-base);
        }

        .professional-item {
            background: var(--procounsel-white);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--procounsel-border-color);
            display: flex;
            align-items: flex-start;
            gap: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .professional-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .professional-icon {
            width: 50px;
            height: 50px;
            background: var(--procounsel-base);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .professional-icon i {
            color: var(--procounsel-white);
            font-size: 1.2rem;
        }

        .professional-content h5 {
            color: var(--procounsel-primary);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .professional-content p {
            color: var(--procounsel-text);
            margin: 0;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Additional Details Section */
        .additional-details-section {
            background: var(--procounsel-white);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--procounsel-border-color);
        }

        .additional-title {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .additional-title i {
            color: var(--procounsel-base);
        }

        .team-additional-details {
            color: var(--procounsel-text-dark);
            line-height: 1.7;
            font-size: 1rem;
        }

        /* Sidebar Styles */
        .sidebar-sticky {
            position: sticky;
            top: 30px;
        }

        .sidebar-card {
            background: var(--procounsel-white);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--procounsel-border-color);
        }

        .sidebar-title {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-title i {
            color: var(--procounsel-base);
        }

        /* Team Members Styles */
        .team-member-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            transition: background-color 0.3s ease;
        }

        .team-member-item:hover {
            background-color: var(--procounsel-gray);
        }

        .team-member-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .team-member-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .placeholder-image {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--procounsel-base), var(--procounsel-primary));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .placeholder-image i {
            color: var(--procounsel-white);
            font-size: 1.5rem;
        }

        .team-member-content h6 {
            margin: 0 0 5px 0;
            font-size: 1rem;
            line-height: 1.3;
        }

        .team-member-content h6 a {
            color: var(--procounsel-primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .team-member-content h6 a:hover {
            color: var(--procounsel-base);
        }

        .team-member-content p {
            color: var(--procounsel-base);
            font-size: 0.9rem;
            font-weight: 500;
            margin: 0 0 5px 0;
        }

        .team-member-content small {
            color: var(--procounsel-text);
            font-size: 0.8rem;
            line-height: 1.4;
        }

        /* Social Share Styles */
        .social-share {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            color: var(--procounsel-white);
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            color: var(--procounsel-white);
            text-decoration: none;
        }

        .social-btn.facebook {
            background-color: #1877f2;
        }

        .social-btn.twitter {
            background-color: #1da1f2;
        }

        .social-btn.linkedin {
            background-color: #0077b5;
        }

        .social-btn.whatsapp {
            background-color: #25d366;
        }

        /* Contact Form Styles */
        .contact-form .form-group {
            margin-bottom: 20px;
        }

        .contact-form label {
            color: var(--procounsel-primary);
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            font-size: 0.9rem;
        }

        .contact-form .form-control {
            border: 2px solid var(--procounsel-border-color);
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: var(--procounsel-white);
            color: var(--procounsel-primary);
        }

        .contact-form .form-control:focus {
            border-color: var(--procounsel-base);
            box-shadow: 0 0 0 0.2rem rgba(199, 149, 74, 0.25);
            outline: none;
        }

        .contact-form .form-control::placeholder {
            color: var(--procounsel-text-gray);
        }

        .btn-contact {
            background: linear-gradient(135deg, var(--procounsel-base), var(--procounsel-primary));
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            color: var(--procounsel-white);
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-contact:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(199, 149, 74, 0.3);
            color: var(--procounsel-white);
        }

        .btn-contact:focus {
            box-shadow: 0 0 0 0.2rem rgba(199, 149, 74, 0.5);
            outline: none;
        }

        .btn-back {
            background: transparent;
            color: var(--procounsel-primary);
            border: 2px solid var(--procounsel-primary);
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-back:hover {
            background: var(--procounsel-primary);
            color: var(--procounsel-white);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(25, 34, 58, 0.3);
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .team-details-section {
                padding: 40px 0;
            }

            .team-content-card {
                padding: 25px;
                margin-bottom: 25px;
            }

            .team-name {
                font-size: 2rem;
            }

            .sidebar-card {
                padding: 25px;
                margin-bottom: 20px;
            }

            .sidebar-sticky {
                position: static;
            }
        }

        @media (max-width: 767.98px) {
            .team-content-card {
                padding: 20px;
            }

            .team-name {
                font-size: 1.8rem;
            }

            .sidebar-card {
                padding: 20px;
            }

            .professional-item {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .team-member-item {
                flex-direction: column;
                text-align: center;
            }

            .team-member-image {
                width: 100px;
                height: 100px;
                align-self: center;
            }
        }

        @media (max-width: 575.98px) {
            .team-details-section {
                padding: 30px 0;
            }

            .team-content-card {
                padding: 15px;
            }

            .sidebar-card {
                padding: 15px;
            }

            .team-name {
                font-size: 1.5rem;
            }

            .social-btn {
                width: 40px;
                height: 40px;
            }

            .team-image img,
            .placeholder-avatar {
                width: 150px;
                height: 180px;
            }
        }

        /* Custom animations */
        .team-content-card,
        .sidebar-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading animation for form submission */
        .btn-contact.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-contact.loading::after {
            content: "";
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid var(--procounsel-white);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Team-specific styling differences */
        .team-member-item {
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .team-member-item:hover {
            border-left-color: var(--procounsel-base);
        }

        /* Team-specific professional icon styling */
        .professional-icon {
            background: linear-gradient(135deg, var(--procounsel-base), var(--procounsel-primary));
        }

        /* Tab Styles */
        .tab-button {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            outline: none;
        }

        .tab-button.active {
            color: var(--procounsel-primary) !important;
            border-bottom-color: var(--procounsel-primary) !important;
        }

        .tab-button.active .w-6 {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .tab-panel {
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .tab-panel.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive tab navigation */
        @media (max-width: 768px) {
            .tab-button {
                font-size: 0.875rem;
                padding: 0.75rem 1rem;
            }

            .tab-button .w-6 {
                width: 1.25rem;
                height: 1.25rem;
            }
        }

        @media (max-width: 640px) {
            .tab-button {
                flex-direction: column;
                text-align: center;
                gap: 0.25rem;
                padding: 0.75rem 0.5rem;
            }

            .tab-button span {
                font-size: 0.75rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function switchTab(event, tabId) {
            // Prevent default behavior
            event.preventDefault();

            // Remove active class from all tab buttons
            const tabButtons = document.querySelectorAll('.tab-button');
            tabButtons.forEach(button => {
                button.classList.remove('active');
                button.setAttribute('aria-selected', 'false');
            });

            // Hide all tab panels
            const tabPanels = document.querySelectorAll('.tab-panel');
            tabPanels.forEach(panel => {
                panel.classList.remove('active');
            });

            // Add active class to clicked button
            event.currentTarget.classList.add('active');
            event.currentTarget.setAttribute('aria-selected', 'true');

            // Show the selected tab panel
            const selectedPanel = document.getElementById(tabId);
            if (selectedPanel) {
                selectedPanel.classList.add('active');
            }

            // Store the active tab in localStorage for persistence
            localStorage.setItem('activeTeamTab', tabId);
        }

        // Initialize tabs when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Check if there's a stored active tab
            const storedTab = localStorage.getItem('activeTeamTab');

            // If there's a stored tab and it exists on the page, activate it
            if (storedTab && document.getElementById(storedTab)) {
                // Find the button for the stored tab
                const storedButton = document.querySelector(`[onclick="switchTab(event, '${storedTab}')"]`);
                if (storedButton) {
                    // Remove active from all
                    const tabButtons = document.querySelectorAll('.tab-button');
                    const tabPanels = document.querySelectorAll('.tab-panel');

                    tabButtons.forEach(button => {
                        button.classList.remove('active');
                        button.setAttribute('aria-selected', 'false');
                    });

                    tabPanels.forEach(panel => {
                        panel.classList.remove('active');
                    });

                    // Activate the stored tab
                    storedButton.classList.add('active');
                    storedButton.setAttribute('aria-selected', 'true');
                    document.getElementById(storedTab).classList.add('active');
                }
            }
        });
    </script>
