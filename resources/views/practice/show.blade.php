@extends('layouts.app')

@section('head')
    <x-meta-tags :title="$practice->meta_title ?: $practice->title . ' - Professional Legal Practice'" :description="$practice->meta_description ?: $practice->excerpt" :keywords="$practice->meta_keywords" :image="$practice->feature_image_url" type="article" :post="$practice" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner 
        :title="$practice->title" 
        :breadcrumbs="[
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Practice Areas', 'url' => route('practices.index')],
            ['label' => $practice->title]
        ]"
    />

    {{-- Main Content Section --}}
    <section id="content" class="py-10 bg-white">
        <div class="container mx-auto">
            <div class="grid xl:grid-cols-4 gap-2">
                <!-- Main Content -->
                <div class="xl:col-span-3">
                    <!-- Practice Content -->
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 lg:p-12 mb-8">
                        <div class="prose prose-lg prose-slate max-w-none">
                            <div class="mb-8 pb-8 border-b border-gray-200">
                                <!-- Right Content - Featured Image -->
                                <div class="relative">
                                    @if ($practice->feature_image_url)
                                        <div class="relative group">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-purple-600/20 to-transparent rounded-3xl">
                                            </div>
                                            <img src="{{ $practice->feature_image_url }}" alt="{{ $practice->title }}"
                                                class="w-full h-96 lg:h-[500px] object-cover rounded-3xl shadow-2xl transform transition-transform duration-700 group-hover:scale-105">
                                            <div
                                                class="absolute inset-0 rounded-3xl bg-gradient-to-t from-black/20 to-transparent">
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class="flex items-center justify-center w-full h-96 lg:h-[500px] bg-gradient-to-br from-purple-900/20 to-blue-900/20 rounded-3xl border border-purple-500/20 backdrop-blur-sm">
                                            <div class="text-center">
                                                <svg class="w-24 h-24 text-purple-400/50 mx-auto mb-4" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                                <p class="text-purple-300 text-lg font-medium">Professional Legal Service
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-gray-700 leading-relaxed">
                                {!! $practice->content ?: $practice->description !!}
                            </div>
                        </div>
                    </div>

                    <!-- Key Highlights -->
                    <div
                        class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-3xl shadow-xl border border-emerald-100 p-8 lg:p-12 mb-8">
                        <h3 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-cyan-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            Key Highlights
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div
                                class="flex items-start space-x-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 5h2a2 2 0 012 2v6a2 2 0 01-2 2h-2a2 2 0 01-2-2V7a2 2 0 012-2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Professional Research</h4>
                                    <p class="text-gray-600 text-sm">Comprehensive legal research and analysis</p>
                                </div>
                            </div>
                            <div
                                class="flex items-start space-x-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-teal-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Verified Content</h4>
                                    <p class="text-gray-600 text-sm">Reviewed and verified by legal experts</p>
                                </div>
                            </div>
                            <div
                                class="flex items-start space-x-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-cyan-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Free Access</h4>
                                    <p class="text-gray-600 text-sm">Open access to legal knowledge and resources</p>
                                </div>
                            </div>
                            <div
                                class="flex items-start space-x-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Expert Insights</h4>
                                    <p class="text-gray-600 text-sm">Professional insights and practical guidance</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Call to Action -->
                    <div
                        class="bg-gradient-to-r from-slate-900 to-purple-900 rounded-3xl shadow-2xl p-8 lg:p-12 text-white">
                        <div class="text-center max-w-2xl mx-auto">
                            <div
                                class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                                <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold mb-4">Ready to Get Started?</h3>
                            <p class="text-xl text-purple-200 mb-8 leading-relaxed">
                                Contact our experienced legal team to discuss your specific needs and learn how we can help
                                you achieve the best possible outcome.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="{{ url('/contact') }}"
                                    class="inline-flex items-center justify-center px-8 py-4 bg-white text-slate-900 font-semibold rounded-2xl transform transition-all duration-300 hover:bg-gray-100 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/30 shadow-xl">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    Schedule Consultation
                                </a>
                                <a href="tel:+1234567890"
                                    class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold rounded-2xl border-2 border-white/30 transform transition-all duration-300 hover:bg-white/10 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/30">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    Call Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="xl:col-span-1">
                    <div class="sticky top-8 space-y-8">
                        <!-- Practice Info Card -->
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                            <div class="w-100 bg-white">
                                <h2 class="text-xl font-semibold mb-4 text-gray-800">Contact Us</h2>
                                <form class="space-y-4">
                                    <!-- Full Name -->
                                    <div>
                                        <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Full
                                            Name</label>
                                        <input type="text" id="fullname" name="fullname"
                                            placeholder="Enter your name"
                                            class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email"
                                            class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <input type="email" id="email" name="email"
                                            placeholder="Enter your email"
                                            class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label for="phone"
                                            class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                        <input type="tel" id="phone" name="phone"
                                            placeholder="Enter your phone number"
                                            class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                    </div>

                                    <!-- Subject -->
                                    <div>
                                        <label for="subject"
                                            class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                                        <input type="text" id="subject" name="subject" placeholder="Enter subject"
                                            class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                    </div>

                                    <!-- Message -->
                                    <div>
                                        <label for="message"
                                            class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                        <textarea id="message" name="message" rows="3" placeholder="Write your message"
                                            class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                                        Send Message
                                    </button>
                                </form>
                            </div>


                        </div>

                        <!-- Share Card -->
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Share This Practice</h4>
                            <div class="grid grid-cols-3 gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank"
                                    class="bg-blue-600 text-white p-3 rounded-xl text-center hover:bg-blue-700 transition-colors duration-300 group">
                                    <svg class="w-5 h-5 mx-auto group-hover:scale-110 transition-transform duration-300"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($practice->title) }}"
                                    target="_blank"
                                    class="bg-blue-400 text-white p-3 rounded-xl text-center hover:bg-blue-500 transition-colors duration-300 group">
                                    <svg class="w-5 h-5 mx-auto group-hover:scale-110 transition-transform duration-300"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                    target="_blank"
                                    class="bg-blue-800 text-white p-3 rounded-xl text-center hover:bg-blue-900 transition-colors duration-300 group">
                                    <svg class="w-5 h-5 mx-auto group-hover:scale-110 transition-transform duration-300"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($practice->title . ' - ' . request()->url()) }}"
                                    target="_blank"
                                    class="bg-green-500 text-white p-3 rounded-xl text-center hover:bg-green-600 transition-colors duration-300 group">
                                    <svg class="w-5 h-5 mx-auto group-hover:scale-110 transition-transform duration-300"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.525 3.488" />
                                    </svg>
                                </a>

                                <!-- Viber -->
                                <a href="viber://forward?text={{ urlencode($practice->title . ' - ' . request()->url()) }}"
                                    target="_blank"
                                    class="bg-purple-600 text-white p-3 rounded-xl text-center hover:bg-purple-700 transition-colors duration-300 group">
                                    <svg class="w-5 h-5 mx-auto group-hover:scale-110 transition-transform duration-300"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M11.398.002C9.473.024 5.331.344 3.014 2.467A6.65 6.65 0 0 0 .702 6.698c-.394 2.733-.196 5.783.51 8.427l-1.22 4.478L4.49 18.31c2.212.65 4.56.837 6.908.554 3.952-.477 6.817-3.554 7.523-7.436.901-4.95-.666-9.218-4.487-11.976C13.186.434 11.398.002 11.398.002zm.067 1.697c.017 0 .033.003.05.003 1.662.003 3.105.32 4.429 1.091 3.318 1.93 4.573 5.383 3.783 9.234-.592 2.884-2.849 5.355-5.934 5.745-2.016.253-4.097.046-6.003-.507L4.5 17.915l.936-3.43c-.615-2.36-.777-4.94-.447-7.37.405-2.988 2.208-5.135 4.476-5.416z" />
                                        <path
                                            d="M11.398 3.11c-.51.017-1.09.137-1.643.414-1.245.625-2.171 1.863-2.46 3.237-.21 1.001-.125 2.048.145 3.018.216.775.533 1.508.93 2.188.636 1.09 1.483 2.022 2.498 2.734.637.447 1.341.804 2.091 1.027.377.112.768.17 1.162.17.394 0 .785-.058 1.162-.17.593-.177 1.146-.469 1.618-.856.236-.193.448-.417.618-.673.17-.256.297-.544.367-.856.07-.312.084-.638.04-.963-.044-.325-.132-.64-.26-.93-.128-.29-.297-.553-.505-.777-.208-.224-.454-.408-.723-.541-.269-.133-.564-.216-.865-.244-.301-.028-.605.01-.896.112-.291.102-.567.264-.795.487-.228.223-.408.5-.526.81-.118.31-.175.645-.168.982.007.337.075.67.2.975.125.305.307.582.535.81.228.228.502.408.806.531.304.123.634.189.968.195.334.006.669-.052.983-.171.314-.119.605-.297.853-.524.248-.227.451-.503.594-.814.143-.311.225-.651.242-.998.017-.347-.027-.696-.13-1.02-.103-.324-.266-.624-.478-.877-.212-.253-.472-.458-.765-.6-.293-.142-.616-.22-.942-.23-.326-.01-.654.052-.958.184-.304.132-.581.333-.81.585-.229.252-.409.554-.528.886-.119.332-.177.69-.17 1.05.007.36.077.716.207 1.044.13.328.318.628.554.883.236.255.519.458.833.598.314.14.654.217.999.227.345.01.691-.05 1.016-.177.325-.127.623-.322.873-.572.25-.25.452-.551.592-.884.14-.333.219-.695.232-1.063.013-.368-.048-.738-.18-1.078-.132-.34-.334-.649-.593-.905-.259-.256-.574-.459-.926-.595-.352-.136-.736-.205-1.124-.202-.388.003-.773.078-1.126.22-.353.142-.672.351-.936.612-.264.261-.473.572-.614.912-.141.34-.214.708-.214 1.08 0 .372.073.74.214 1.08.141.34.35.651.614.912.264.261.583.47.936.612.353.142.738.217 1.126.22.388-.003.772-.066 1.124-.202.352-.136.667-.339.926-.595.259-.256.461-.565.593-.905.132-.34.193-.71.18-1.078-.013-.368-.092-.73-.232-1.063-.14-.333-.342-.634-.592-.884-.25-.25-.548-.445-.873-.572-.325-.127-.671-.187-1.016-.177-.345-.01-.685.087-.999.227-.314-.14-.597-.343-.833-.598-.236-.255-.424-.555-.554-.883-.13-.328-.2-.684-.207-1.044-.007-.36.051-.718.17-1.05.119-.332.299-.634.528-.886.229-.252.506-.453.81-.585.304-.132.632-.194.958-.184.326.01.649.088.942.23.293.142.553.347.765.6.212.253.375.553.478.877.103.324.147.673.13 1.02-.017.347-.099.687-.242.998-.143.311-.346.587-.594.814-.248.227-.539.405-.853.524-.314.119-.649.177-.983.171-.334-.006-.664-.072-.968-.195-.304-.123-.578-.303-.806-.531-.228-.228-.41-.505-.535-.81-.125-.305-.193-.638-.2-.975-.007-.337.05-.672.168-.982.118-.31.298-.587.526-.81.228-.223.504-.385.795-.487.291-.102.595-.14.896-.112.301.028.596.111.865.244.269.133.515.317.723.541.208.224.377.487.505.777.128.29.216.605.26.93.044.325.03.651-.04.963-.07.312-.197.6-.367.856-.17.256-.382.48-.618.673-.472.387-1.025.679-1.618.856-.377.112-.768.17-1.162.17z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Practices --}}
    @if ($relatedPractices->count() > 0)
        <section class="py-20 bg-gradient-to-br from-gray-50 to-emerald-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <div
                        class="inline-block mb-4 px-6 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full text-sm font-semibold tracking-wide">
                        Explore More
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Related <span
                            class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Practices</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Discover other professional practices that might interest you
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($relatedPractices as $relatedPractice)
                        <div class="group">
                            <div
                                class="bg-white rounded-3xl shadow-lg overflow-hidden transform transition-all duration-500 hover:scale-105 hover:shadow-2xl border border-gray-100">
                                <div class="relative overflow-hidden h-48 bg-gradient-to-br from-emerald-100 to-teal-100">
                                    @if ($relatedPractice->feature_image_url)
                                        <img src="{{ $relatedPractice->feature_image_url }}"
                                            alt="{{ $relatedPractice->title }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full">
                                            <svg class="w-16 h-16 text-emerald-400/50" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-6">
                                    <h3
                                        class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-emerald-600 transition-colors duration-300">
                                        {{ $relatedPractice->title }}
                                    </h3>

                                    @if ($relatedPractice->excerpt)
                                        <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                            {{ $relatedPractice->excerpt }}
                                        </p>
                                    @endif

                                    <a href="{{ route('practice.show', $relatedPractice->slug) }}"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-sm font-semibold rounded-2xl transform transition-all duration-300 hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                        <span>Read More</span>
                                        <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('styles')
    <style>
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .line-clamp-3 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4,
        .prose h5,
        .prose h6 {
            color: #1f2937;
            font-weight: 700;
        }

        .prose h2 {
            @apply text-2xl mt-8 mb-4;
        }

        .prose h3 {
            @apply text-xl mt-6 mb-3;
        }

        .prose p {
            @apply mb-4 leading-relaxed;
        }

        .prose ul,
        .prose ol {
            @apply mb-4 pl-6;
        }

        .prose li {
            @apply mb-2;
        }

        .prose a {
            @apply text-emerald-600 hover:text-emerald-800 transition-colors duration-200;
        }

        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #059669, #0d9488);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #047857, #0f766e);
        }
    </style>
@endpush
