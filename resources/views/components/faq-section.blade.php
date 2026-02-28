@props(['faqs', 'title' => 'Frequently Asked Question'])

@if ($faqs && $faqs->count() > 0)
    <x-page-section-title :title="'<span>' . $title . '</span>'" />
    <section class="py-8 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="bg-gradient-to-br from-white to-gray-50/50 rounded-[2.5rem] lg:p-6 mb-4 relative overflow-hidden">
                <!-- Background Decoration -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-accent/5 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 relative z-10">
                    @foreach ($faqs as $faq)
                        <div class="faq-item group bg-blue-100 border border-blue-100/20 rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:shadow-blue-100/30 hover:scale-[1.02] hover:bg-blue-100/90">
                            <button class="faq-question w-full text-left lg:px-8 px-4 py-6 flex justify-between items-center gap-6 outline-none">
                                <span class="text-lg font-semibold text-black group-hover:text-black/90 transition-colors duration-300">
                                    {{ $faq->question }}
                                </span>
                                <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center transition-all duration-500 group-[.active]:bg-white group-hover:bg-white/20">
                                    <svg class="w-6 h-6 text-black group-[.active]:text-accent group-[.active]:rotate-180 transition-all duration-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer overflow-hidden max-h-0 opacity-0 transition-all duration-500 ease-in-out">
                                <div class="px-8 pb-8">
                                    <div class="prose prose-lg max-w-none text-black leading-relaxed text-justify border-t border-white/10 pt-4">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @once
        @push('styles')
            <style>
                .faq-answer {
                    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                }
                .faq-answer ol { list-style: decimal; padding-left: 1.25rem; }
                .faq-answer ul { list-style: disc; padding-left: 1.25rem; }
                .faq-item.active {
                    border-color: rgba(15, 140, 202, 0.2);
                    box-shadow: 0 25px 50px -12px rgba(15, 140, 202, 0.1);
                }
            </style>
        @endpush

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const faqItems = document.querySelectorAll('.faq-item');
                    faqItems.forEach(item => {
                        const question = item.querySelector('.faq-question');
                        const answer = item.querySelector('.faq-answer');
                        question.addEventListener('click', function() {
                            const isActive = item.classList.contains('active');
                            faqItems.forEach(otherItem => {
                                otherItem.classList.remove('active');
                                const otherAnswer = otherItem.querySelector('.faq-answer');
                                otherAnswer.style.maxHeight = null;
                                otherAnswer.style.opacity = '0';
                            });
                            if (!isActive) {
                                item.classList.add('active');
                                answer.style.maxHeight = answer.scrollHeight + "px";
                                answer.style.opacity = '1';
                            }
                        });
                    });
                });
            </script>
        @endpush
    @endonce
@endif
